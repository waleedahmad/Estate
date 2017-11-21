<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    protected $table = 'agents';

    public function user(){
        return $this->hasOne('App\User', 'user_id', 'id');
    }
}
