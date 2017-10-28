<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Listings extends Model
{
    protected $table = 'listing';

    protected $dates = ['expire_after'];

    public function images(){
        return $this->hasMany('App\ListingImages', 'listing_id', 'id');
    }

    public function town(){
        return $this->hasOne('App\Towns', 'id', 'town_id');
    }

    public function location(){
        return $this->hasOne('App\ListingLocation', 'listing_id', 'id');
    }

    public function deleteListingImages(){
        foreach($this->images as $image){
            Storage::disk('public')->delete($image->image_uri);
        }
    }
}
