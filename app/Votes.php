<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //

    public function matchs(){
        return $this->belongsToMany('App\Matchs');
    }

    public function user(){
        return $this->belongsToMany('App\User');
    }
}
