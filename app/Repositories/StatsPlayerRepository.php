<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 20/01/2020
 * Time: 11:13
 */
namespace App\Repositories;
use App\HatPlayer;
use App\StatsPlayer;
use Illuminate\Support\Facades\DB;


class StatsPlayerRepository
{

    protected $statsPlayer;
    protected  $hatPlayer;

    public function __construct(StatsPlayer $statsPlayer, HatPlayer $hatPlayer)
    {
        $this->statsPlayer = $statsPlayer;
        $this->hatPlayer = $hatPlayer;
    }

    public function save($statsPlayer)
    {
        $this->statsPlayer->statsPlayer = $statsPlayer;
        $this->statsPlayer->save();
    }


    public static function getOverallAverageCurrent($playerId)
    {
        $lastMatch = DB::table('votes')
            ->select('votes.assigned_rating')
            ->where('votes.match_id', DB::raw("(select max(`match_id`) from votes)"))
            ->where('votes.vote_to_player_id', $playerId)//todo where match not closed
            ->get();
        $arr = $lastMatch->pluck('assigned_rating')->toArray();
        if(empty($arr)){
            return null;
        }

        return array_sum($arr)/count($arr);
    }


    public static function rankingPlayer($playerId){
         $allPlayers = DB::table('stats_players')
                ->select('current_rating', 'player_id')
                ->orderBy('current_rating', 'desc')
                ->get();
        foreach ($allPlayers as $key => $player) {
            if((int) $player->player_id == (int) $playerId){
                return $key + 1;
            }
        }
        return null;
    }


    public function update($request) {

        $statsPlayer = StatsPlayer::find($request->idStatsPlayer);
        $hat = HatPlayer::where('player_id', $request->idStatsPlayer)->first()
        ;

        $hatLegend = HatPlayer::where('player_id', $request->idStatsPlayer)->get();

        if($request->legend != null){
            $statsPlayer->legend = '1';
            if(!in_array( 100,  $hatLegend->pluck('hat_id')->toArray())){
               HatPlayer::create([
                   'hat_id' => 100,
                   'player_id' => $request->idStatsPlayer
               ]);
            }
        }else{
            if(in_array( 100,  $hatLegend->pluck('hat_id')->toArray())){
                HatPlayer::where([
                    'hat_id' => 100,
                    'player_id' => $request->idStatsPlayer
                ])->delete();
            }
        }


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
        $statsPlayer->strong_foot = $request->strong_foot;

        $hat->hat_id  = $this->hatPlayer->managePlayerHat($request->current_rating);
        $hat->player_id = $request->idStatsPlayer;
        $hat->save();
        $statsPlayer->save();

    }

}