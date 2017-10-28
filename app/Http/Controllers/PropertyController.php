<?php

namespace App\Http\Controllers;

use App\Cities;
use App\FavoriteListings;
use App\ListingLocation;
use App\Listings;
use App\Towns;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{

    public function getProperties(){
        $listings = Listings::where('user_id','=',Auth::id())->where('approved', '=', true)->paginate(20);
        return view('property.my_properties')->with('listings', $listings);
    }

    public function getFavoriteProperties(){
        $faved = FavoriteListings::where('user_id', '=', Auth::id())->pluck('listing_id');
        $listings = Listings::whereIn('id', $faved)->paginate(20);
        return view('property.my_properties')->with('listings', $listings);
    }

    public function getPendingProperties(){
        $listings = Listings::where('user_id','=',Auth::id())->where('approved', '=', false)->paginate(20);
        return view('property.my_properties')->with('listings', $listings);
    }

    public function getProperty($id){
        $listing = Listings::find($id);
        $r_listings = Listings::where('id','!=',$listing->id)->take(3)->get();
        return view('property.property')->with('listing', $listing)->with('r_listings', $r_listings);
    }


    public function propertyForm(){
        return view('property.add');
    }

    public function submitProperty(Request $request){
        $listing = new Listings();
        $listing->title = $request->name;
        $listing->description = $request->description;
        $listing->price = $request->price;
        $listing->land_area = $request->land_area;
        $listing->area_units = $request->area_units;
        $listing->expire_after = Carbon::now()->addMonth($request->expire_after);
        $listing->purpose = $request->purpose;
        $listing->type = $request->propertyType;
        $listing->sub_type = $request->subType;
        $listing->town_id = $request->location;
        $listing->show_slider = false;
        $listing->show_recent = false;
        $listing->user_id = Auth::id();
        $listing->approved = false;

        if($listing->save()){
            if(strlen($request->lat) && strlen($request->lng)){
                $listing_location = new ListingLocation();
                $listing_location->listing_id = $listing->id;
                $listing_location->lat = $request->lat;
                $listing_location->lng = $request->lng;
                if($listing_location->save()){
                    return response()->json([
                        'created'   =>  true,
                        'listing_id'    =>  $listing->id
                    ]);
                }
            }
            return response()->json([
                'created'   =>  true,
                'listing_id'    =>  $listing->id
            ]);

        }
        return response()->json([
            'created'   =>  false,
        ]);
    }

    public function updateListing(Request $request){
        $listing = Listings::find($request->id);
        $listing->title = $request->name;
        $listing->description = $request->description;
        $listing->price = $request->price;
        $listing->land_area = $request->land_area;
        $listing->area_units = $request->area_units;
        $listing->expire_after = Carbon::now()->addMonth($request->expire_after);
        $listing->purpose = $request->purpose;
        $listing->type = $request->propertyType;
        $listing->sub_type = $request->subType;
        $listing->town_id = $request->location;

        if($listing->save()){
            if(strlen($request->lat) && strlen($request->lng)){
                $listing_location = ListingLocation::where('listing_id','=', $listing->id);
                if($listing_location->count()){
                    $listing_location = $listing_location->first();
                    $listing_location->lat = $request->lat;
                    $listing_location->lng = $request->lng;
                    if($listing_location->save()){
                        return response()->json([
                            'updated'   =>  true,
                        ]);
                    }
                }else{
                    $listing_location = new ListingLocation();
                    $listing_location->listing_id = $listing->id;
                    $listing_location->lat = $request->lat;
                    $listing_location->lng = $request->lng;
                    if($listing_location->save()){
                        return response()->json([
                            'updated'   =>  true,
                            'listing_id'    =>  $listing->id
                        ]);
                    }
                }

            }
            return response()->json([
                'updated'   =>  true,
            ]);

        }
        return response()->json([
            'created'   =>  false,
        ]);
    }

    public function validateListing(Request $request){
        $validator = \Validator::make($request->all(), [
            'name'  =>  'required',
            'description'   =>  'required',
            'price' =>  'required|numeric|min:1',
            'land_area' =>  'required|numeric|min:1',
            'area_units' => 'required',
            'expire_after' => 'required',
            'purpose'  =>  'required',
            'propertyType'  =>  'required',
            'subType'   =>  'required',
            'city'  =>  'required',
            'location'  =>  'required'
        ]);

        if($validator->passes()){
            return response()->json([
                'passes' => true,
                'error' =>  []
            ]);
        }else{
            return response()->json([
                'passes' => false,
                'errors' => $validator->messages()
            ]);
        }
    }

    public function getCityLocations(Request $request){
        $city = Cities::find($request->id);
        return response()->json($city->towns->toArray());
    }

    public function getTownInfo(Request $request){
        $town = Towns::with('coords')->find($request->id);
        return response()->json($town);
    }

    public function removeListing(Request $request){
        $listing = Listings::find($request->id);
        $listing->deleteListingImages();
        if($listing->delete()){
            return response()->json([
                'removed'  =>  true
            ]);
        }
    }

    public function getEditProperty($id){
        $listing = Listings::find($id);
        return view('property.edit')->with('listing', $listing);
    }

    public function getPropertyImages(Request $request){
        $listing = Listings::find($request->id);
        return response()->json($listing->images);
    }

    public function toggleListingFavorites(Request $request){
        if($request->status){
            $listing_favorite = new FavoriteListings();
            $listing_favorite->user_id = Auth::id();
            $listing_favorite->listing_id = $request->id;
            if($listing_favorite->save()){
                return response()->json(true);
            }

        }else{
            $listing_favorite = FavoriteListings::where('user_id', '=', Auth::id())->where('listing_id', '=', $request->id);
            if($listing_favorite->delete()){
                return response()->json(true);
            }
        }
    }

    public function removeListingFavorites(Request $request){
        $fav_listing = FavoriteListings::where('listing_id', '=', $request->id)->with('user_id', '=', Auth::id());

        if($fav_listing->delete()){
            return response()->json(true);
        }
    }

}
