<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Coords;
use App\Rules\UniqueTown;
use App\Towns;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getLocations(){
        $cities = Cities::all();
        return view('admin.locations.locations')->with('cities', $cities);
    }

    public function getLocation($id){
        $city = Cities::find($id);
        return view('admin.locations.city')->with('city', $city);
    }

    public function getTown($id){
        $town = Towns::find($id);
        return view('admin.locations.town')->with('town', $town);
    }

    public function addCities(){
        return view('admin.locations.add_city');
    }

    public function saveCity(Request $request){
        $validator = \Validator::make($request->all(), [
            'city'  =>  'required|unique:cities,name'
        ]);

        if($validator->passes()){
            $city = new Cities();
            $city->name = $request->city;
            if($city->save()){
                return redirect('/admin/locations');
            }
        }else{
            return redirect('/admin/locations/cities/add')->withErrors($validator)->withInput();
        }
    }

    public function addTown($id){
        $city = Cities::find($id);
        return view('admin.locations.add_town')->with('city', $city);
    }

    public function saveTown(Request $request){
        $validator = \Validator::make($request->all(), [
            'town'  =>  [
                'required',
                new UniqueTown($request->city_id)
            ]
        ]);


        if($validator->passes()){
            $town = new Towns();
            $town->name = $request->town;
            $town->city_id = $request->city_id;

            if($town->save()){
                if(strlen($request->lng) && strlen($request->lat)){
                    $coords = new Coords();
                    $coords->town_id = $town->id;
                    $coords->lat = $request->lat;
                    $coords->lng = $request->lng;
                    if($coords->save()){
                        return redirect('/admin/locations/'.$request->city_id);
                    }
                }
            }
        }else{
            return redirect('/admin/locations/city/'.$request->city_id.'/add')->withErrors($validator)->withInput();
        }

    }
}
