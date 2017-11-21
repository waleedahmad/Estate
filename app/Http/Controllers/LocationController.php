<?php

namespace App\Http\Controllers;

use App\Blocks;
use App\Cities;
use App\Coords;
use App\Rules\UniqueBlock;
use App\Rules\UniqueTown;
use App\Rules\UniqueUpdateBlock;
use App\State;
use App\Towns;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCities(){
        $states = State::all();
        return view('admin.locations.cities')->with('states', $states);
    }

    public function getCity($id){
        $city = Cities::find($id);
        return view('admin.locations.city')->with('city', $city);
    }

    public function addCities(){
        return view('admin.locations.add_city');
    }

    public function saveCity(Request $request){
        $validator = \Validator::make($request->all(), [
            'city'  =>  'required|unique:cities,name',
            'state' =>  'required',
        ]);

        if($validator->passes()){
            $city = new Cities();
            $city->name = $request->city;
            $city->state_id = $request->state;
            if($city->save()){
                return redirect('/admin/cities');
            }
        }else{
            return redirect('/admin/cities/add')->withErrors($validator)->withInput();
        }
    }

    public function deleteCity(Request $request){
        $city = Cities::find($request->id);
        if($city->towns->count()){
            return response()->json([
                'allowed'   =>  false,
                'deleted'   =>  false
            ]);
        }else{
            if($city->delete()){
                return response()->json([
                    'allowed'   =>  true,
                    'deleted'   =>  true
                ]);
            }else{
                return response()->json([
                    'allowed'   =>  true,
                    'deleted'   =>  false
                ]);
            }
        }
    }

    public function getTown($id){
        $town = Towns::find($id);
        return view('admin.locations.town')->with('town', $town);
    }

    public function editCity($id){
        $city = Cities::find($id);
        return view('admin.locations.edit_city')->with('city', $city);
    }

    public function updateCity(Request $request){
        $validator = \Validator::make($request->all(), [
            'city'  =>  'required|unique:cities,name',
            'state' =>  'required',
        ]);

        if($validator->passes()){
            $city = Cities::find($request->id);
            $city->name = $request->city;
            $city->state_id = $request->state;
            if($city->save()){
                return redirect('/admin/cities');
            }
        }else{
            return redirect('/admin/cities/edit/'.$request->id)->withErrors($validator)->withInput();
        }
    }

    public function addTown($id){
        $city = Cities::find($id);
        return view('admin.locations.add_town')->with('city', $city);
    }

    public function editTown($id){
        $town = Towns::find($id);
        return view('admin.locations.edit_town')->with('town', $town);
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
                return redirect('/admin/cities/'.$request->city_id);
            }
        }else{
            return redirect('/admin/city/'.$request->city_id.'/town/add')->withErrors($validator)->withInput();
        }

    }

    public function deleteTown(Request $request){
        $town = Towns::find($request->id);
        if($town->blocks->count()){
            return response()->json([
                'allowed'   =>  false,
                'deleted'   =>  false
            ]);
        }else{
            if($town->delete()){
                return response()->json([
                    'allowed'   =>  true,
                    'deleted'   =>  true
                ]);
            }else{
                return response()->json([
                    'allowed'   =>  true,
                    'deleted'   =>  false
                ]);
            }
        }
    }

    public function updateTown(Request $request){
        $validator = \Validator::make($request->all(), [
            'town'  =>  [
                'required',
                new UniqueTown($request->id)
            ]
        ]);


        if($validator->passes()){
            $town = Towns::find($request->id);
            $town->name = $request->town;

            if($town->save()){
                return redirect('/admin/cities/town/'.$town->id);
            }
        }else{
            return redirect('/admin/cities/town/'.$request->id.'/edit')->withErrors($validator)->withInput();
        }
    }

    public function addBlock($town_id){
        $town = Towns::find($town_id);
        return view('admin.locations.add_block')->with('town', $town);
    }

    public function saveBlock(Request $request){
        $validator = \Validator::make($request->all(), [
            'block'  =>  [
                'required',
                new UniqueBlock($request->town_id)
            ]
        ]);

        if($validator->passes()){
            $block = new Blocks();
            $block->name = $request->block;
            $block->town_id = $request->town_id;

            if($block->save()){
                $coords = new Coords();
                $coords->block_id = $block->id;
                $coords->lat = $request->lat;
                $coords->lng = $request->lng;

                if($coords->save()){
                    return redirect('/admin/cities/town/'.$request->town_id);

                }
            }
        }else{
            return redirect('/admin/cities/town/'.$request->town_id.'/block/add')->withErrors($validator)->withInput();
        }
    }

    public function showBlock($id){
        $block = Blocks::find($id);
        return view('admin.locations.block')->with('block', $block);
    }

    public function deleteBlock(Request $request){
        $block = Blocks::find($request->id);
        if($block->delete()){
            return response()->json([
                'deleted' => true
            ]);
        }

        return response()->json([
            'deleted' => false
        ]);
    }

    public function editBlock($id){
        $block = Blocks::find($id);
        return view('admin.locations.edit_block')->with('block', $block);
    }

    public function updateBlock(Request $request){
        $block = Blocks::find($request->id);
        $validator = \Validator::make($request->all(), [
            'block'  =>  [
                'required',
                new UniqueUpdateBlock($block->town->id, $block->id)
            ]
        ]);

        if($validator->passes()){
            $block->name = $request->block;

            if($block->save()){
                $coords = $block->coords;
                $coords->lat = $request->lat;
                $coords->lng = $request->lng;

                if($coords->save()){
                    return redirect('/admin/cities/town/block/'.$block->id);

                }
            }
        }else{
            return redirect('/admin/cities/town/block/'.$block->id.'/edit')->withErrors($validator)->withInput();
        }
    }
}
