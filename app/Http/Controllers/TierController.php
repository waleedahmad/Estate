<?php

namespace App\Http\Controllers;

use App\Tiers;
use App\User;
use App\UserTiers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TierController extends Controller
{
    public function getUserTiers(){
        $tiers = Tiers::all();
        $users = User::where('type', '!=', 'admin')->where('type', '!=', 'agent')->paginate(20);
        return view('admin.tiers.user_tiers')->with('users', $users)->with('tiers', $tiers);
    }

    public function getTierConfig(){
        $tiers = Tiers::all();
        return view('admin.tiers.tier_config')->with('tiers', $tiers);
    }

    public function getAddTier(){
        return view('admin.tiers.add_tier');
    }

    public function addTier(Request $request){
        $validator = \Validator::make($request->all(), [
            'name'  =>  'required|unique:tiers,name',
            'allowed_listings'  =>  'required|numeric|min:1'
        ]);

        if($validator->passes()){
            $tier = new Tiers();
            $tier->name = $request->name;
            $tier->allowed_listings = $request->allowed_listings;
            if($tier->save()){
                return redirect('/admin/config/tiers');
            }
        }else{
            return redirect('/admin/config/tiers/add')->withErrors($validator)->withInput();
        }
    }

    public function getEditTiers($id){
        $tier = Tiers::find($id);
        return view('admin.tiers.edit_tier')->with('tier', $tier);
    }

    public function updateTier(Request $request){
        $validator = \Validator::make($request->all(), [
            'name'  =>  [
                'required',
                Rule::unique('tiers')->ignore($request->id),
            ],
            'allowed_listings'  =>  'required|numeric|min:1'
        ]);

        if($validator->passes()){
            $tier = Tiers::find($request->id);
            $tier->name = $request->name;
            $tier->allowed_listings = $request->allowed_listings;
            if($tier->save()){
                return redirect('/admin/config/tiers');
            }
        }else{
            return redirect('/admin/config/tiers/'.$request->id.'/edit')->withErrors($validator)->withInput();
        }
    }

    public function deleteTier(Request $request){

        $tier = Tiers::find($request->id);

        if($tier->hasUserTiers->count()){
            return response()->json([
                'deleted'   =>  false,
                'error_type'    =>  'assigned'
            ]);
        }else{
            if($tier->delete()){
                return response()->json([
                    'deleted'   =>  true
                ]);
            }
        }
        return response()->json([
            'deleted'   =>  true
        ]);

    }

    public function modifyUserTiers(Request $request){
        $user_tier = UserTiers::where('user_id', '=', $request->id);

        if($user_tier->count()){
            if($user_tier->update([
                'tier_id'   =>  $request->tier_id
            ])){
                return response()->json(true);
            }
        }else{
            $user_tier = new UserTiers();
            $user_tier->user_id = $request->id;
            $user_tier->tier_id = $request->tier_id;

            if($user_tier->save()){
                return response()->json(true);
            }
        }


        return response()->json(false);

    }
}
