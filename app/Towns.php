<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Towns extends Model
{
    protected $table = 'towns';

    public function city(){
        return $this->hasOne('App\Cities', 'id', 'city_id');
    }

    public function coords(){
        return $this->hasOne('App\Coords', 'town_id', 'id');
    }
}
