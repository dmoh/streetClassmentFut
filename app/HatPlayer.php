<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HatPlayer extends Model
{
    //

    public function hats(){
        return $this->belongsToMany('App\Hats');
    }

    public function statsPlayer(){
        return $this->belongsToMany('App\StatsPlayer');
    }
}
