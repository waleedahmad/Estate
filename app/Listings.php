<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Listings extends Model
{
    protected $table = 'listing';

    protected $dates = ['expire_after'];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function images(){
        return $this->hasMany('App\ListingImages', 'listing_id', 'id');
    }

    public function block(){
        return $this->hasOne('App\Blocks', 'id', 'block_id');
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
