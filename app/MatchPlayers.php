<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchPlayers extends Model
{
    //

    public function matchs() {
        return $this->belongsToMany('App\Matchs');
    }


    public function players(){
        return $this->belongsToMany('App\StatsPlayer');
    }
}
