<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsPlayer extends Model
{
    //

    public function user(){
        return $this->belongsTo('App\User', 'player_stat_id');
    }

    public function statsMatchs(){
        return $this->hasMany('App\StatsMatchs', 'player_id');
    }

    public function matchs(){
        return $this->belongsToMany('App\Matchs');
    }

    public function hat(){
        return $this->hasOne('App\Hats');
    }
}
