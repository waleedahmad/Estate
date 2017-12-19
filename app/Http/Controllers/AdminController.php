<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex(){
        return view('admin.index');
    }

    public function getAdmins(){
        $users = User::where('type', '=', 'admin')->paginate(20);
        return view('admin.administrators.index')->with('users', $users);
    }

    public function addAdmin(){
        return view('admin.administrators.add');
    }

    public function createAdmin(Request $request){

        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'email' =>  'required|email|unique:users',
            'gender'    =>  '',
            'password' => 'required|string|min:6',
            'confirm_password'  =>  'required|same:password',
            'phone_no'  =>  ($request->has('phone_no')) ? 'phone:PK' : '',

        ]);

        if($validator->passes()){
            $user = new \App\User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->image_uri = 'default/default.jpg';
            $user->phone = $request->phone_no;
            $user->type = 'admin';
            $user->gender = $request->gender;
            $user->verified = 1;

            if($user->save()){
                return redirect('/admin/admins');
            }
        }else{
            return redirect('/admin/admins/add')->withErrors($validator)->withInput();
        }
    }

    public function deleteAdmin(Request $request)
    {
        return response()->json([
            'deleted'   =>  User::find($request->id)->delete()
        ]);
    }
}
