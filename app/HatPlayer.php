<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HatPlayer extends Model
{
    //


    protected $fillable = [
        'hat_id', 'player_id'
    ];

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

    // players, note du match obtenue, note globale joueur, hat_player
    final static function movePlayerHatByCurrentRating($overallAverage, $currentRating){
        $playerHat = HatPlayer::changePlayerHat($currentRating);
        switch ($playerHat){
            case 4:
                if($overallAverage > 6){
                    $currentRating += 2;
                }
                break;
            case 3:
                if($overallAverage > 7){
                    $currentRating += 1;
                }
                break;

            case 2:
                if($overallAverage > 8){
                    $currentRating += 1;
                }
                break;
            case 1:
                if($overallAverage > 8.5){
                    $currentRating += 1;
                }
                break;
        }


        $playerHat = HatPlayer::changePlayerHat($currentRating);


        return ['playerHat' => $playerHat, 'currentRating' => $currentRating];
    }
}
