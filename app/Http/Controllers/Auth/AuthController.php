<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Teacher;
use App\Models\Student;

class AuthController extends Controller
{

    private $teacher;
    private $student;

    public function __construct(Teacher $teacher, Student $student){
        $this->teacher = $teacher;
        $this->student = $student;
    }

    public function login (){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        $studentCode = Session::get('studentCode');
        $idAdmin = Auth::id();
        if(isset($idAdmin)){
            return redirect()->route('home');
        }
        else if(isset($idClassTeacher) && isset($idUserTeacher)){
            return redirect()->route('home');
        }
        else if(isset($studentCode)){
            return redirect()->route('student.login-home',['student_code'=>$studentCode]);
        }
        return view('login.login');
    }

    public function postLogin(AuthLoginRequest $request){
        $teacherUser = $this->teacher->where('email',$request->user)->first();
        $studentUser = $this->student->where('student_code',$request->user)->first();
        if(Auth::attempt([
            'email'=>$request->user,
            'password'=>$request->password
        ])){
            return redirect()->route('home');
        }
        else if(isset($teacherUser) && Hash::check($request->password, $teacherUser->password)){
            $idUserTeacher = $teacherUser->id;
            $idClassTeacher = $teacherUser->id_class;
            Session::put('idUserTeacher',$idUserTeacher);
            Session::put('idClassTeacher',$idClassTeacher);
            return redirect()->route('home');
        }
        else if(isset($studentUser) && Hash::check($request->password, $studentUser->password)){
            $studentCode = $studentUser->student_code;
            $idStudentGrade = $studentUser->class->id_grade;
            Session::put('idStudentGrade',$idStudentGrade);
            Session::put('studentCode',$studentCode);
            return redirect()->route('student.login-home',['student_code' => $studentCode]);
        }
        else{
            return redirect()->route('login');
        }
    }

    public function logout(){
        $idUserTeacher = Session::get('idUserTeacher');
        $studentCode = Session::get('studentCode');
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('login');
        }
        else if(isset($idUserTeacher)){
            Session::flush();
            return redirect()->route('login');
        }
        else if(isset($studentCode)){
            Session::flush();
            return redirect()->route('login');
        }
    }
}
