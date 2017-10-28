<?php

namespace App\Http\Controllers;

use App\Layout;
use App\Listings;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        if($request->view === 'sidebar'){
            $listings = Listings::where(function($query) use ($request){
                if($request->propertyType != 'ANY'){
                    $query->where('type', '=', $request->propertyType);
                }
                })->whereHas('town.city' , function($query) use ($request) {
                if($request->location != 'ANY'){
                    $query->where('id','=', $request->location);
                }
            })->paginate(20);

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

}
