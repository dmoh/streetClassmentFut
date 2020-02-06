<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 03/02/2020
 * Time: 12:53
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class MatchPlayerRatingRepository
{


    public final static function  getRatingPlayerCurrent($matchId, $playerId, $ratingAwarded){
        $ratingPlayerCurrent = DB::table('match_player_rating')
            ->where([
                'match_id' => $matchId,
                'player_id' => $playerId
            ])
            ->first()
        ;

        $ratingAwarded = $ratingAwarded != 0 ? $ratingAwarded : 1;

        if($ratingPlayerCurrent != null){
            $ratingCurrent = ($ratingPlayerCurrent->rating + $ratingAwarded) / 2;
        }else{
            $ratingCurrent = $ratingAwarded;
        }

        return $ratingCurrent;

    }
}