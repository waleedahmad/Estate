<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Layout;
use App\Listings;
use App\State;
use App\Towns;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        if($request->view === 'sidebar') {
            $listings = Listings::where(function ($query) use ($request) {
                if ($request->propertyType != 'ANY') {
                    $query->where('type', '=', $request->propertyType);
                }
            })->whereHas('block.town.city', function ($query) use ($request) {
                if ($request->location != 'ANY') {
                    $query->where('id', '=', $request->location);
                }
            })->paginate(20);

            return $this->getListingLayout($listings);
        }elseif($request->view === 'main'){
            $listings = Listings::where(function ($query) use ($request) {
                if ($request->propertyType != 'Any') {
                    $query->where('type', '=', $request->propertyType);
                }

                if ($request->subType != 'Any') {
                    $query->where('sub_type', '=', $request->subType);
                }
                if($request->purpose != 'ALL'){
                    $query->where('purpose', '=', $request->purpose);
                }
                $query->whereBetween('price', [$request->priceMin, $request->priceMax])->get();
            })->whereHas('block', function ($query) use ($request) {
                if ($request->block != 'Any') {
                    $query->where('id', '=', $request->block);
                }
            })->whereHas('block.town', function ($query) use ($request) {
                if ($request->town != 'Any') {
                    $query->where('id', '=', $request->town);
                }
            })->whereHas('block.town.city', function ($query) use ($request) {
                if ($request->city != 'Any') {
                    $query->where('id', '=', $request->city);
                }
            })->whereHas('block.town.city.state', function ($query) use ($request) {
                if ($request->state != 'Any') {
                    $query->where('id', '=', $request->state);
                }
            })
            ->paginate(20);
            return $this->getListingLayout($listings);
        }
    }

    public function getListingLayout($listings){
        switch(Layout::find(2)->layout_name){
            case 'Listing Grid':
                return view('listings.listing_grid')->with('listings', $listings);
            case 'Listing Grid Sidebar':
                return view('listings.listing_grid_sidebar')->with('listings', $listings);
            case 'Listing Grid Masonry':
                return view('listings.listing_grid_masonary')->with('listings', $listings);
            case 'Listing Row':
                return view('listings.listing_grid_row')->with('listings', $listings);
            case 'Listing Row Sidebar':
                return view('listings.listing_grid_row_sidebar')->with('listings', $listings);
        }
    }


    public function getCities(Request $request){
        $cities = State::find($request->id)->cities->toArray();
        return response()->json($cities);
    }

    public function getTowns(Request $request){
        $towns = Cities::find($request->id)->towns->toArray();
        return response()->json($towns);
    }

    public function getBlocks(Request $request){
        $blocks = Towns::find($request->id)->blocks->toArray();
        return response()->json($blocks);
    }

}
