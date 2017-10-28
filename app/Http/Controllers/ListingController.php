<?php

namespace App\Http\Controllers;

use App\Layout;
use App\Listings;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    // Main site methods


    public function getListings(){
        $listings = Listings::where('approved', '=', true)->paginate(20);
        return $this->getListingLayout($listings);
    }

    public function getCategorizedListings($type){
        $listings = Listings::where('purpose','=', $type)->where('approved', '=', true)->paginate(20);
        return $this->getListingLayout($listings);
    }

    public function getSubTypListings($type){
        $listings = Listings::where('sub_type','=', $type)->where('approved', '=', true)->paginate(20);
        return $this->getListingLayout($listings);
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

    // Admin Methods

    public function getListingSubmissions(){
        $listing = Listings::where('approved','=', false)->paginate(20);
        return view('admin.listings.submissions')->with('listings', $listing);
    }

    public function getApprovedListings(){
        $listing = Listings::where('approved','=', true)->paginate(20);
        return view('admin..listings.listings')->with('listings', $listing);
    }

    public function getSliderRecentListings(){
        $listing = Listings::where('approved','=', true)->paginate(20);
        return view('admin..listings.recent_slider_listings')->with('listings', $listing);
    }

    public function getCategorizedSliderRecentListings($type){
        if($type === 'Slider'){
            $listing = Listings::where('approved','=', true)->where('show_slider', '=', true)->paginate(20);
        }else if($type === 'Recent'){
            $listing = Listings::where('approved','=', true)->where('show_recent', '=', true)->paginate(20);
        }
        return view('admin.listings.recent_slider_listings')->with('listings', $listing);
    }

    public function getCategorizedAdminListings($type){
        $listing = Listings::where('approved','=', false)->where('purpose', '=', $type)->paginate(20);
        return view('admin.listings.submissions')->with('listings', $listing);
    }

    public function getCategorizedApprovedListings($type){
        $listing = Listings::where('approved','=', true)->where('purpose', '=', $type)->paginate(20);
        return view('admin.listings.listings')->with('listings', $listing);
    }



    public function approveListing(Request $request){
        $listing = Listings::find($request->id);
        $listing->approved = true;
        if($listing->save()){
            return response()->json([
                'approved'  =>  true
            ]);
        }
    }

    public function deleteListing(Request $request){
        $listing = Listings::find($request->id);
        $listing->deleteListingImages();
        if($listing->delete()){
            return response()->json([
                'deleted'  =>  true
            ]);
        }
    }

    public function disapproveListing(Request $request){
        $listing = Listings::find($request->id);
        $listing->approved = false;
        if($listing->save()){
            return response()->json([
                'disapproved'  =>  true
            ]);
        }
    }

    public function modifyListingDisplaySettings(Request $request){
        $listing = Listings::find($request->id);
        switch($request->action){
            case 'slider':
                $listing->show_slider = $request->status;
                break;
            case 'recent';
                $listing->show_recent = $request->status;
        }
        if($listing->save()){
            return response()->json(true);
        }

    }
}
