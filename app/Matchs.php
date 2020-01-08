<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    //
    public function statsPlayer(){
        return $this->belongsToMany('App\StatsPlayer', 'match_players', 'match_id');
    }

    public function votes(){
        return $this->belongsToMany('App\Votes');
    }
}
