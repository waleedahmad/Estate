<?php

namespace App\Http\Controllers;

use App\Agents;
use App\Tiers;
use App\User;
use App\UserTiers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $users = User::where('type', '!=', 'admin')->paginate(20);
        return view('admin.users')->with('users', $users);
    }

    public function modifyUserType(Request $request){
        $user = User::find($request->id);
        $type = $request->type;

        if($type === 'agent'){
            $agent = new Agents();
            $agent->user_id = $request->id;
            $agent->featured = false;
            $agent->description = '';
            $user->type = 'agent';

            if($agent->save() && $user->Tier->delete() && $user->save()){
                return response()->json(true);
            }
        }else if($type === 'user'){
            $user->type = 'user';
            $tier = Tiers::orderBy('allowed_listings', 'ASC');
            if($tier->count()){
                $tier = $tier->first();
                $user_tier = new UserTiers();
                $user_tier->tier_id = $tier->id;
                $user_tier->user_id = $user->id;
                $user_tier->save();
            }

            if($user->Agent->delete() && $user->save()){
                return response()->json(true);
            }
        }
    }

    public function getDashboard(){
        return view('user.index');
    }

}
