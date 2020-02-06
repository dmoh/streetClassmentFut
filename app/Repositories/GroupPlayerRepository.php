<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 31/01/2020
 * Time: 09:11
 */

namespace App\Repositories;


use App\StatsPlayer;
use Illuminate\Support\Facades\DB;

class GroupPlayerRepository
{

    protected $groupId;
    public final static function getAllPlayersByGroupId($idGroup){
        return DB::table('stats_players')
            ->join('group_player', 'group_player.player_id', '=', 'stats_player.player_id')
            ->join('groups', 'groups.id', '=', 'group_player.group_id')
            ->join('users', 'users.id', '=', 'stats_player.player_id')
            ->where('groups.id', '=', $idGroup)
            ->get()
        ;
    }


    //get match  with players by group Id
    public final static function getAllMatchByGroupId($idGroup){
        return DB::table('matchs')
            ->join('group_match', 'group_match.group_id', '=',  'groups.id')
            ->join('matchs', 'matchs.id', '=', 'group_match.match_id')
            ->where('groups.id', '=', $idGroup)
            ->get();
    }


    /*public final static function getAllGroups(){
        return DB::table('groups')

    }*/
}