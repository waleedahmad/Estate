<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';

    public function towns(){
        return $this->hasMany('App\Towns','city_id', 'id');
    }

    public function state(){
        return $this->hasOne('App\State', 'id', 'state_id');
    }
}
