<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\ClassGrade;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Classes\ClassAddRequest;
use App\Http\Requests\Classes\ClassEditRequest;

class ClassGradeController extends Controller
{
    private $grade;
    private $classGrade;

    public function __construct(Grade $grade, ClassGrade $classGrade){
        $this->grade = $grade;
        $this->classGrade = $classGrade;
    }

    public function index($id){
        $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
        if($id == 'all'){
            $classGrades = $this->classGrade->whereNotIn('class_grade',['Đã tốt nghiệp'])->orderBy('class_grade')->paginate(10);
            return view('class.index',compact('classGrades','grades'));
        }else{
            $classGrades = $this->classGrade->whereNotIn('class_grade',['Đã tốt nghiệp'])->where('id_grade',$id)->orderBy('class_grade')->paginate(10);
            return view('class.index',compact('classGrades','grades'));
        }
    }

    public function search(Request $request){
        $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
        $classGrades = $this->classGrade->where('class_grade','like','%'.$request->class.'%')->orderBy('class_grade')->get();
        return view('class.search',compact('classGrades','grades'));
    }

    public function create (){
        $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
        return view('class.create', compact('grades'));
    }

    public function store (ClassAddRequest $request) {
        try {
            $this->classGrade->create([
            'id_grade' => $request->id_grade,
            'class_grade' => $request->class_grade,
        ]);
        return redirect()->route('classes.index',['id'=>$request->id_grade])->with('message_success','Tạo lớp '.$request->class_grade.' thành công');
        } catch (\Exception $e) {
            Log::error('Message:'.$e->getMessage());
        }
        
    }

    public function edit($id){
        $grades = $this->grade->whereNotIn('id',[4])->get();
        $class = $this->classGrade->find($id);
        return view('class.edit', compact('grades','class'));
    }

    public function update($id , ClassEditRequest $request){
        try {
            $this->classGrade->find($id)->update([
            'id_grade' => $request->id_grade,
            'class_grade' => $request->class_grade
            ]);
            return redirect()->route('classes.index')->with('message_success','Cập nhật lớp thành công');
        } catch (\Exception $e) {
            Log::error('Message:'.$e->getMessage());
        }
    }

    public function delete($id){
        $this->classGrade->find($id)->delete();
        return redirect()->route('classes.index');
    }
}
