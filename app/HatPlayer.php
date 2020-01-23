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


    public function managePlayerHat($current_rating){
        if((int)$current_rating > 88){
            return 1;
        }elseif ((int)$current_rating <= 88
            &&(int)$current_rating > 85
        ){
            return 2;
        }elseif ((int)$current_rating <= 85
            &&(int)$current_rating > 75){
            return 3;
        }elseif ((int)$current_rating <= 75){
            return 4;
        }
    }


    final static function changePlayerHat($current_rating){
        if((int)$current_rating > 88){
            return 1;
        }elseif ((int)$current_rating <= 88
            &&(int)$current_rating > 85
        ){
            return 2;
        }elseif ((int)$current_rating <= 85
            &&(int)$current_rating > 75){
            return 3;
        }elseif ((int)$current_rating <= 75){
            return 4;
        }
    }
}
