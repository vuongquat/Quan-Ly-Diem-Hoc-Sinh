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
        if(isset($idClassTeacher) && isset($idUserTeacher)){
            return view('home');
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
            
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function logout(){
        $idUserTeacher = Session::get('idUserTeacher');
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('login');
        }
        else if(isset($idUserTeacher)){
            Session::flush();
            return redirect()->route('login');
        }
    }
}
