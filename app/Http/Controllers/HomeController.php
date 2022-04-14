<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Auth;

class HomeController extends Controller
{

    private $user;
    private $teacher;

    public function __construct(User $user, Teacher $teacher){
        $this->user = $user;
        $this->teacher = $teacher;
    }

    public function index(){
        $idUserTeacher = Session::get('idUserTeacher');
        $idAdmin = Auth::id();
        if(isset($idAdmin)){
            $userLogin = $this->user->find($idAdmin);
            return view('home',compact('userLogin'));
        }
        else if(isset($idUserTeacher)){
            $userLogin = $this->teacher->find($idUserTeacher);
            return view('home',compact('userLogin'));
        }
        return abort(403);
    }
}
