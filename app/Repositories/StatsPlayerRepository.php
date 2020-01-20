<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 20/01/2020
 * Time: 11:13
 */
namespace App\Repositories;
use App\StatsPlayer;


class StatsPlayerRepository
{

    protected $statsPlayer;

    public function __construct(StatsPlayer $statsPlayer)
    {
        $this->statsPlayer = $statsPlayer;
    }

    public function save($statsPlayer)
    {
        $this->statsPlayer->statsPlayer = $statsPlayer;
        $this->statsPlayer->save();
    }


    public function update($request) {

        $statsPlayer = StatsPlayer::find($request->idStatsPlayer);

        $statsPlayer->current_rating = $request->current_rating;
        $statsPlayer->assists = $request->assists;
        $statsPlayer->goals = $request->goals;
        $statsPlayer->pace = $request->pace;
        $statsPlayer->shoot = $request->shoot;
        $statsPlayer->passe = $request->passe;
        $statsPlayer->dribble = $request->dribble;
        $statsPlayer->defense = $request->defense;
        $statsPlayer->physique = $request->physique;
        $statsPlayer->skill = $request->skill;
        $statsPlayer->position = $request->position;

        $statsPlayer->save();

    }

}