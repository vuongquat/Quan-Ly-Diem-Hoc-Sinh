<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\SchoolYear;
use App\Models\GPASubject;
use App\Models\GPASchoolYear;

class StudentLoginController extends Controller
{

    private $grade;
    private $student;
    private $semester;
    private $schoolYear;
    private $gpaSubject;
    private $gpaSchoolYear;

   public function __construct(Grade $grade, Student $student, SchoolYear $schoolYear, Semester $semester, GPASubject $gpaSubject, GPASchoolYear $gpaSchoolYear){
        $this->grade = $grade;
        $this->student = $student;
        $this->semester = $semester;
        $this->schoolYear = $schoolYear;
        $this->gpaSubject = $gpaSubject;
        $this->gpaSchoolYear = $gpaSchoolYear;
    }

    public function index(){
        $studentCode = Session::get('studentCode');
        if(isset($studentCode)){
            $studentLogin = $this->student->where('student_code',$studentCode)->first();
            return view('student_login.home', compact('studentLogin'));
        }
        else{
            return abort(403);
        }
    }

    public function transcript($studentCode,$id_grade){
        $studentCode = Session::get('studentCode');
        $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
        $studentGrade = $this->grade->find($id_grade);
        $studentLogin = $this->student->where('student_code',$studentCode)->first();
        $gpaSubjects = $this->gpaSubject->where('id_student',$studentLogin->id)->where('id_grade',$id_grade)->get();
        $gpaSchoolYear = $this->gpaSchoolYear->where('id_student',$studentLogin->id)->where('id_grade',$id_grade)->get();
        return view('student_login.transcript',compact('grades','gpaSubjects','studentLogin','gpaSchoolYear','studentGrade'));
    }
}
