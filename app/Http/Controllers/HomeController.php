<?php

namespace App\Http\Controllers;

use App\Layout;
use App\Listings;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getIndex(){
        $slider_listings = Listings::orderBy('created_at','DESC')->where('approved','=',true)->where('show_slider','=', true)->take(10)->get();
        $recent_listings = Listings::orderBy('created_at','DESC')->where('approved','=',true)->where('show_recent','=', true)->take(10)->get();
        $agents = User::where('type', '=', 'agent')->take(4)->get();

        return $this->getIndexLayout($slider_listings, $recent_listings, $agents);
    }

    private function getIndexLayout($slider_listings, $recent_listings, $agents){
        switch(Layout::find(1)->layout_name){
            case 'Home Horizontal Filter':
                return view('index')
                    ->with('slider_listings',$slider_listings)
                    ->with('recent_listings', $recent_listings)
                    ->with('agents', $agents);
            case 'Home Map':
                return view('index_map')
                    ->with('slider_listings',$slider_listings)
                    ->with('recent_listings', $recent_listings)
                    ->with('agents', $agents);
        }
    }
}
