<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public function cities(){
        return $this->hasMany('App\Cities', 'state_id', 'id');
    }
}
