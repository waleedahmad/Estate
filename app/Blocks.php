<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    protected $table = 'blocks';

    public function town(){
        return $this->hasOne('App\Towns', 'id', 'town_id');
    }

    public function coords(){
        return $this->hasOne('App\Coords', 'block_id', 'id');
    }
}
