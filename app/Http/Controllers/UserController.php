<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\user\UserAddRequest;
use App\Http\Requests\user\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        $users = $this->user->whereNotIn('id_role',[1])->orderBy('first_name')->get();
        return view('user.index',compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(UserAddRequest $request){
        try{
            $date = $request->date_of_birth;
            $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
            $password = Hash::make($newDate);
            $this->user->create([
                'id_role' => 2,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender' => $request->gender,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'date_of_birth'=>$date,
                'email'=>$request->email,
                'password'=>$password
            ]);
            return redirect()->route('users.index')->with('message','Tạo quản trị viên thành công');
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('users.index')->with('message','Lỗi'.$e);
        }
    }

    public function edit($id){
        $user = $this->user->find($id);
        return view('user.edit',compact('user'));
    }

    public function update($id, UserEditRequest $request){
        try{
            $date = $request->date_of_birth;
            $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
            $password = Hash::make($newDate);
            $this->user->find($id)->update([
                'id_role' => 2,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'gender' => $request->gender,
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'date_of_birth'=>$date,
                'email'=>$request->email,
                'password'=>$password
            ]);
            return redirect()->route('users.index')->with('message','Sửa thành công');
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('users.index')->with('message','Lỗi'.$e);
        }
    }

    public function delete($id){
        try{
            $this->user->find($id)->delete();
            return redirect()->route('users.index');
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('users.index')->with('message','Lỗi'.$e);
        }
    }
}
