<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hats extends Model
{
    //

    public function statsPlayer(){
        return $this->hasMany('App\StatsPlayer');
    }



}
