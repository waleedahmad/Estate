<?php

namespace App\Http\Controllers;

use App\Rules\OldPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(){
        return view('user.settings');
    }

    public function updateEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email|unique:users,id,'.Auth::user()->id
        ]);

        if($validator->passes()){
            $user = Auth::user();
            $user->email = $request->email;
            if($user->save()){
                return redirect('/user/settings')->with('email_update', 'Email updated');
            }

        }else{
            return redirect('/user/settings')->withErrors($validator)->withInput();
        }
    }

    public function updatePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password'  =>  [
                'required',
                new OldPassword
            ],
            'password' => 'required|string|min:6',
            'confirm_password'  =>  'required|same:password',
        ]);

        if($validator->passes()){
            $user = Auth::user();
            $user->password = bcrypt($request->password);
            if($user->save()){
                return redirect('/user/settings#profile-settings')->with('password_update', 'Password updated');
            }
        }else{
            return redirect('/user/settings#profile-settings')->withErrors($validator)->withInput();
        }

    }

    public function updateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'gender'    =>  '',
            'phone_no'  =>  ($request->has('phone_no')) ? 'phone:PK' : '',
            'profile_picture'   =>  ($request->hasFile('profile_picture'))? 'required|image' : ''
        ]);

        if($validator->passes()){

            $user = Auth::user();

            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->phone = $request->phone_no;
            if($request->hasFile('profile_picture')){
                $user->image_uri = $this->updateProfilePictureAndGetURI($request->file('profile_picture'));
            }

            if($user->save()){
                return redirect('/user/settings')->with('profile_update', 'Profile Updated');
            }

        }else{
            return redirect('/user/settings')->withErrors($validator)->withInput();
        }
    }

    private function updateProfilePictureAndGetURI($image){
        $path = 'profile_pic/'.str_random(20).'.'.$image->extension();

        if(!$this->userHasDefaultProfileImage()){
            $this->deleteProfilePicture();
        }

        if(Storage::disk('public')->put($path,  File::get($image))){
            return $path;
        }
    }

    private function userHasDefaultProfileImage(){
        return (Auth::user()->image_uri === 'default/default.jpg');
    }

    private function deleteProfilePicture(){
        return Storage::disk('public')->delete(Auth::user()->image_uri);
    }

    public function updateAgentInfo(Request $request){
        $agent = Auth::user()->Agent;
        $agent->office_phone = $request->office_no;
        $agent->description = $request->description;
        $agent->facebook = $request->facebook;
        $agent->twitter = $request->twitter;
        $agent->google_plus = $request->google_plus;
        if($agent->save()){
            return redirect('/user/settings');
        }
    }
}
