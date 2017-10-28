<?php

namespace App\Http\Controllers;

use App\Agents;
use App\Cities;
use App\Config;
use App\Coords;
use App\Layout;
use App\ListingLocation;
use App\Listings;
use App\Rules\UniqueTown;
use App\Tiers;
use App\Towns;
use App\User;
use App\UserTiers;
use Couchbase\UserSettings;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex(){
        return view('admin.index');
    }
}
