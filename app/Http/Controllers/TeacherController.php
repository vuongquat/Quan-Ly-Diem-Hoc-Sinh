<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\teacher\TeacherAddRequest;
use App\Http\Requests\teacher\TeacherEditRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassGrade;
use App\Models\Teacher;
use Carbon\Carbon;
use Auth;

class TeacherController extends Controller
{
    private $classGrade;
    private $teacher;

    public function __construct(ClassGrade $classGrade, Teacher $teacher){
        $this->classGrade = $classGrade;
        $this->teacher = $teacher;
    } 

    public function index(){
            $teachers = $this->teacher->orderBy('first_name')->paginate(10);
            return view('teacher.index',compact('teachers'));
    }

    public function search(Request $request){   
            $teachers = $this->teacher->where('first_name','like','%'.$request->teacher.'%')->orWhere('first_name','like','%'.$request->teacher.'%')->orderBy('first_name')->get();
            return view('teacher.search',compact('teachers'));
    }

    public function create(){
            $classGrades = $this->classGrade->whereNotIn('class_grade',['Đã tốt nghiệp'])->orderBy('class_grade')->get();
            return view('teacher.create',compact('classGrades'));
    }

    public function store(TeacherAddRequest $request){
            try{
            $date = $request->date_of_birth;
            $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
            $password = Hash::make($newDate);
            $this->teacher->create([
                'id_class'=> $request->id_class,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender' => $request->gender,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'date_of_birth'=>$date,
                'email'=>$request->email,
                'password'=>$password
            ]);
                return redirect()->route('teacher.index')->with('message','Thêm giáo viên thành công');
            }
            catch(\Exception $e){
                Log::error('Message:'.$e->getMessage());
                return redirect()->route('teacher.index')->with('message','Lỗi');
            }   
    }

    public function edit($id){
            $classGrades = $this->classGrade->whereNotIn('class_grade',['Đã tốt nghiệp'])->orderBy('class_grade')->get();
            $teacher = $this->teacher->find($id);
            return view('teacher.edit',compact('classGrades','teacher'));
    }

    public function update($id, TeacherEditRequest $request){
            try{
            $date = $request->date_of_birth;
            $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
            $password = Hash::make($newDate);
            $this->teacher->find($id)->update([
                'id_class'=> $request->id_class,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender' => $request->gender,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'date_of_birth'=>$date,
                'email'=>$request->email,
                'password'=>$password
            ]);
                return redirect()->route('teacher.index')->with('message','Sửa giáo viên thành công');
            }
            catch(\Exception $e){
                Log::error('Message:'.$e->getMessage());
                return redirect()->route('teacher.index')->with('message','Lỗi');
            }
    }

    public function delete($id){
            try{
            $this->teacher->find($id)->delete();
            return redirect()->route('teacher.index');
            }
            catch(\Exception $e){
                Log::error('Message:'.$e->getMessage());
            }
    }
}
