<?php

namespace App\Http\Controllers\FrontEnd;

use App\Repositories\StatsPlayerRepository;
use App\StatsPlayer;
use App\Upload;
use App\Hats;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    //

        public function index(){

            $players = DB::table('hats')
                        ->join('hat_players', 'hat_players.hat_id', '=', 'hats.id')
                        ->join('stats_players', 'stats_players.stats_player_id', '=', 'hat_players.player_id')
                        ->join('users', 'users.id', '=', 'stats_players.user_id')
                        ->leftJoin('uploads', 'uploads.user_id', '=', 'stats_players.user_id')
                        ->where('hats.id', '=', 1)
                        ->distinct()
            ->orderBy('stats_players.current_rating', 'desc')
                        ->get();



            return view('FrontEnd/index', compact('players'));
        }

    public function showPlayerByHat(Request $request)
    {
        if ($request->ajax()) {
            $playersHatId = (int) $request->get('showHat');
            $players = DB::table('hats')
                ->join('hat_players', 'hat_players.hat_id', '=', 'hats.id')
                ->join('stats_players', 'stats_players.stats_player_id', '=', 'hat_players.player_id')
                ->join('users', 'users.id', '=', 'stats_players.user_id')
                ->leftJoin('uploads', 'uploads.user_id', '=', 'stats_players.user_id')
                ->where('hats.id', '=', $playersHatId)
                ->get();
            ;

            return response()->json($players);
        }
    }

    public function showProfile($id) {
        $player = User::findOrFail($id);
        $player = DB::table('users')
            ->join('stats_players', 'stats_players.user_id', '=', 'users.id')
            ->leftJoin('uploads', 'uploads.user_id', '=', 'users.id')
            ->where('stats_players.user_id', $id)
            ->first()
        ;
        $hatNumber = DB::table('hats')
            ->join('hat_players', 'hat_players.hat_id', '=', 'hats.hat_number')
            ->join('stats_players', 'stats_players.player_id', '=', 'hat_players.player_id')
            ->select('hats.hat_number')
            ->where('stats_players.player_id', $id)
            ->first();
        $hat = $hatNumber->hat_number;

        $overallAverage = StatsPlayerRepository::getOverallAverageCurrent($id);
        $rankingPosition = StatsPlayerRepository::rankingPlayer($id);

        // get last five match maybe todo null
       $lastmatchs =  DB::table('matchs')
            ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
            ->join('stats_players', 'stats_players.player_id', '=', 'match_players.stats_player_id')
            ->select('matchs.match_date')
            ->where('stats_players.player_id', $id)
            ->orderBy('matchs.id', 'desc')
            ->limit(5)
            ->get()
       ;


        //get last rating
        $getLastRating =  DB::table('votes')
            ->join('stats_players', 'stats_players.player_id', '=', 'votes.vote_to_player_id')
            ->join('users', 'users.id', '=', 'votes.vote_by_user_id')
            ->select('votes.*', 'users.name')
            ->where('stats_players.player_id', $id)
            ->orderBy('votes.match_id',  'desc')
            ->limit(10)
            ->get()
        ;

        //stats_match by player
        $statsLastMatch =  DB::table('stats_matchs')
            ->where('stats_matchs.player_id', $id)
            ->orderBy('stats_matchs.match_id', 'desc')
            ->limit(1)
            ->get()
        ;

        //get last info game
        $lastRating = $getLastRating->pluck('assigned_rating')->toArray();
        $matchDateFormated = null;


        if(!empty($lastmatchs->pluck('match_date')->toArray())){
            $dateFormated = new \DateTime($lastmatchs->pluck('match_date')->toArray()[0]);
            $matchDateFormated = $dateFormated->format('d/m/Y');
        }





        if(Auth::id() == $id) {
            //todo recherché si des votes en attentes

        }
        return view(
            'FrontEnd/profile',
            compact('player',
                'hat', 'lastRating',
                'lastmatchs',
                'matchDateFormated',
                'getLastRating',
                'statsLastMatch',
                'rankingPosition',
                'overallAverage'));
    }
}
