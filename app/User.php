<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'verified', 'image_uri'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Agent(){
        return $this->hasOne('App\Agents', 'user_id', 'id');
    }

    public function Tier(){
        return $this->hasOne('App\UserTiers', 'user_id', 'id');
    }

    public function FavListing($id){
        return FavoriteListings::where('listing_id', '=', $id)->where('user_id', '=' ,$this->id)->count();
    }

    public function listings(){
        return $this->hasMany('App\Listings', 'user_id', 'id');
    }
}
