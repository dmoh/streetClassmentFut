<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsMatchs extends Model
{
    //

    public function statPlayer(){
        return $this->belongsTo('App\StatsPlayer');
    }
}
