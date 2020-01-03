<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    //
    public function statsPlayers(){
        return $this->belongsToMany('App\StatsPlayer');
    }

    public function votes(){
        return $this->belongsToMany('App\Votes');
    }
}
