<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassGrade;
use App\Models\Student;
use App\Models\Teacher;
use App\Http\Requests\student\StudentAddRequest;
use App\Http\Requests\student\StudentEditRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    private $classGrade;
    private $student;
    private $teacher;

    public function __construct(ClassGrade $classGrade, Student $student, Teacher $teacher){
        $this->classGrade = $classGrade;
        $this->student = $student;
        $this->teacher = $teacher;
    }
    
    public function index($id){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        $classGrades =  $this->classGrade->orderBy('class_grade')->get();
        $pagination = false;
        if(isset($idUserTeacher)){
            $idClass = Session::get('idClassTeacher');
            $class = $this->classGrade->find($idClass);
            $students = $this->student->where('id_class',$class->id)->orderBy('first_name')->get();
            return view('student.index',compact('students','classGrades','class','pagination'));
        }
      
        if(Gate::allows('is-admin')){
            if($id == 'all'){
                $pagination = true;
                $class = '';
                $students = $this->student->orderBy('first_name')->paginate(10);
                return view('student.index',compact('students','classGrades','class','pagination'));
            }else{
                $class = $this->classGrade->find($id);
                $students = $this->student->where('id_class',$id)->orderBy('first_name')->get();
                return view('student.index',compact('students','classGrades','class','pagination'));
            }
        }
        else{
            return redirect()->route('home');
        }
    }

    public function search(Request $request){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        if(isset($idUserTeacher) && isset($idClassTeacher)){
            $classGrades =  $this->classGrade->orderBy('class_grade')->get();
            $students = $this->student->
            where([
                ['first_name','like','%'.$request->student.'%'],
                ['id_class',$idClassTeacher]])
                ->orWhere([
                    ['last_name','like','%'.$request->student.'%'],
                    ['id_class',$idClassTeacher]])
                    ->orWhere([
                        ['student_code','like','%'.$request->student.'%'],
                        ['id_class',$idClassTeacher]])->orderBy('first_name')->get();
            return view('student.search',compact('classGrades','students'));
        }

        if(Gate::allows('is-admin')){
            $classGrades =  $this->classGrade->orderBy('class_grade')->get();
            $students = $this->student->where('first_name','like','%'.$request->student.'%')->orWhere('last_name','like','%'.$request->student.'%')->orWhere('student_code','like','%'.$request->student.'%')->orderBy('first_name')->get();
            return view('student.search',compact('classGrades','students'));
        }
        else{
            return redirect()->route('home');
        }
    }

    public function create(){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        if(isset($idUserTeacher) && isset($idClassTeacher)){
            $classGrades = $this->classGrade->find($idClassTeacher);
            return view('student.create',compact('classGrades'));
        }
        
        if(Gate::allows('is-admin')){
            $classGrades = $this->classGrade->orderBy('class_grade')->get();
            return view('student.create',compact('classGrades'));
        }
        else{
            return view('home');
        }
        
    } 

    public function store(StudentAddRequest $request){
        try{
            $idUserTeacher = Session::get('idUserTeacher');
            $idClassTeacher = Session::get('idClassTeacher');
            $slugName = strtoupper(Str::of($request->first_name)->slug(''));
            $studentCode = 'HS'.$slugName.rand(10000,99999);
            $date = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->format('d/m/Y');
            $password = Hash::make($date);
            if(isset($idUserTeacher) && isset($idClassTeacher)){
                $this->student->create([
                    'student_code'=> $studentCode,
                    'id_class'=>$idClassTeacher,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                return redirect()->route('student.index',['id'=>$idClassTeacher])->with('message','Thêm học sinh thành công');
            }

            if(Gate::allows('is-admin')){
                $this->student->create([
                    'student_code'=> $studentCode,
                    'id_class'=>$request->id_class,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                return redirect()->route('student.index',['id'=>$request->id_class])->with('message','Thêm học sinh thành công');
            }else{
                return redirect()->route('home');
            }
            
            
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('student.index')->with('message',$e->getMessage());
        }
    }

    public function edit($id){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        if(isset($idUserTeacher) && isset($idClassTeacher)){
            $classGrades = $this->classGrade->find($idClassTeacher);
            $student = $this->student->where('id',$id)->where('id_class',$idClassTeacher)->first();
            if(isset($student)){
                return view('student.edit',compact('classGrades','student'));
            }
            else{
                return abort(403);
            }
        }

        if(Gate::allows('is-admin')){
            $classGrades = $this->classGrade->orderBy('class_grade')->get();
            $student = $this->student->find($id);
            return view('student.edit',compact('classGrades','student'));
        }
        else{
            return view('home');
        }
        
    }

    public function update($id, StudentEditRequest $request){
        try{
            $idUserTeacher = Session::get('idUserTeacher');
            $idClassTeacher = Session::get('idClassTeacher');
            $student = $this->student->find($id);
            $date = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->format('d/m/Y');
            $password = Hash::make($date);

            if(isset($idUserTeacher) && isset($idClassTeacher)){
                if($request->first_name != $student->first_name){
                    $slugName = strtoupper(Str::of($request->first_name)->slug(''));
                    $studentCode = 'HS'.$slugName.rand(10000,99999);
                    $this->student->find($id)->update([
                    'student_code'=> $studentCode,
                    'id_class'=>$idClassTeacher,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                }else{
                    $this->student->find($id)->update([
                    'id_class'=>$idClassTeacher,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                }
                return redirect()->route('student.index',['id'=>$request->id_class])->with('message','Sửa học sinh thành công');
            }

            if(Gate::allows('is-admin')){
                if($request->first_name != $student->first_name){
                    $slugName = strtoupper(Str::of($request->first_name)->slug(''));
                    $studentCode = 'HS'.$slugName.rand(10000,99999);
                    $this->student->find($id)->update([
                    'student_code'=> $studentCode,
                    'id_class'=>$request->id_class,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                }else{
                    $this->student->find($id)->update([
                    'id_class'=>$request->id_class,
                    'last_name'=>$request->last_name,
                    'gender'=>$request->gender,
                    'date_of_birth'=>$request->date_of_birth,
                    'address'=>$request->address,
                    'password'=>$password
                ]);
                }
                return redirect()->route('student.index',['id'=>$request->id_class])->with('message','Sửa học sinh thành công');
            }
            else{
                return view('home');
            }
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('student.index')->with('message',$e->getMessage());
        }
    }

    public function delete($id){
        try{
            $idUserTeacher = Session::get('idUserTeacher');
            $idClassTeacher = Session::get('idClassTeacher');

            if(isset($idUserTeacher) && isset($idClassTeacher)){
                $student = $this->student->find($id);
                $idClass = $student->id_class;
                $student = $this->student->where('id',$id)->where('id_class',$idClassTeacher)->delete();
                return redirect()->route('student.index',['id'=>$idClassTeacher]);
            }
            if(Gate::allows('is-admin')){
                $student = $this->student->find($id);
                $idClass = $student->id_class;
                $student = $this->student->find($id)->delete();
                return redirect()->route('student.index',['id'=>$idClass]);
            }
            else{
                return view('home');
            }

            $student = $this->student->find($id);
            $idClass = $student->id_class;
            $student = $this->student->find($id)->delete();
            return redirect()->route('student.index',['id'=>$idClass]);
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('student.index',['id'=>'all'])->with('message',$e->getMessage());
        }
    }
}
