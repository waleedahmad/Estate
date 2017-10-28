<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    protected $table = 'tiers';

    public function hasUserTiers(){
        return $this->hasMany('App\UserTiers', 'tier_id', 'id');
    }
}
