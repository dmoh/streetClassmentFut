<?php

namespace App\Http\Controllers;

use App\HatPlayer;
use App\MatchPlayerRating;
use App\Matchs;
use App\Repositories\MatchPlayerRatingRepository;
use App\Repositories\StatsPlayerRepository;
use App\StatsMatchs;
use App\StatsPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =  Auth::id();
        //getAllMatchPlayedWhereNOVote
        $matchs = DB::table('matchs')
                    ->limit(1)
                    ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
                    ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
                    ->join('users', 'users.id', '=', 'stats_players.player_id')
                    ->select('users.name',  'matchs.id', 'matchs.score', 'matchs.match_date')
                    ->where('users.id', '=', $id)
                    ->where('match_players.voted', false)
                    ->orderBy('matchs.id', 'desc')
                    ->get();

        //getAllPlayerFromMatchs
        $playersMatch = DB::table('matchs')
            ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
            ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
            ->join('users', 'users.id', '=', 'stats_players.user_id')
            ->whereIn('matchs.id', $matchs->pluck('id')->toArray())
            ->whereNotIn('stats_players.player_id', [$id])
            ->select('users.*', 'stats_players.*', 'matchs.score', 'matchs.match_date', 'match_players.match_id')
            ->orderBy('matchs.id', 'desc')
            ->get();

        // My votes
        $votes = DB::table('votes')
            ->join('matchs', 'matchs.id', '=', 'votes.match_id')
            ->whereIn('matchs.id', $matchs->pluck('id')->toArray())
            ->where('votes.vote_to_player_id', $id)
            ->select('votes.*', 'matchs.*')
            ->orderBy('matchs.id', 'desc')
            ->get();

        $mentions = StatsPlayer::getArrayOfSpecialMention();

        return view('FrontEnd/vote', compact('matchs', 'playersMatch', 'votes', 'mentions' ));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function saveVote(Request $request){

        if($request->ajax()){
            $notes = $request->get('notes');
            $matchId = (int) $request->get('matchId');
            $match = Matchs::where('id', $matchId)->first();
            if($match->vote_closed == '1'){
                return response()->json(['error' => 'Les votes sont clos']);
            }

            $playersRatingByMatch = DB::table('match_player_rating')
                ->where('match_id', '=', $matchId)
                ->get()
            ;


            $matchPlayerRating = array();
            $statPlayerOverallAverage = array();
            $matchPlayerRating = array();
            $votes = array();



            //insert
            foreach ($notes as $note) {
                $rating  = $note['scoreAwarded'];
                $playerId = $note['voteToPlayerId'];
                $ratingPlayer = MatchPlayerRatingRepository::getRatingPlayerCurrent($matchId, $playerId, $rating);

                /*$matchPlayerRating[] = [
                    'match_id' => $matchId,
                    'player_id' => $playerId,
                    'rating' => $ratingPlayer
                ];*/
                //save into statsplayer
                //insert into
                DB::table('match_player_rating')
                    ->updateOrInsert([
                        'match_id' => $matchId,
                        'player_id' => $playerId,
                        'rating' => $ratingPlayer
                    ])
                ;

                DB::table('stats_players')
                    ->updateOrInsert([
                        'overall_average' => $ratingPlayer,
                        'player_id' => $playerId,
                    ])
                ;

               /* $votes[] =[
                    'date_of_vote' => now(),
                    'assigned_rating' => $rating,
                    'vote_by_user_id' => Auth::id(), //todo check if is user current
                    'vote_to_player_id' => $playerId,
                    'match_id' => $matchId,
                ];*/

                // insert into votes table
                DB::table('votes')
                    ->updateOrInsert([
                        'date_of_vote' => now(),
                        'assigned_rating' => $rating,
                        'vote_by_user_id' => Auth::id(), //todo check if is user current
                        'vote_to_player_id' => $playerId,
                        'match_id' => $matchId,
                    ])
                ;/**/
            }

            DB::table('match_players')
                ->where(['match_players.stats_player_id' => Auth::id()])
                ->where('match_players.match_id' , $matchId )
                ->update(['voted' => true])
            ;
            return response()->json(['success' => 'success message']);

        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function closeVote(Request $request){
        if($request->ajax()){
            $matchId = (int) $request->get('closeVoteMatchId');
            $dataMatch = Matchs::find($matchId);


            $statsMatchAllplayers = DB::table('stats_matchs')
                                        ->where('match_id', $matchId)
                                        ->get()
            ;

            //désigner hdm
            $playersVote = DB::table('votes')
                ->where('match_id', $matchId)
                ->orderBy('votes.vote_to_player_id', 'DESC')
                ->get()
            ;

            $arrayManOfMatch = [];
            $arrayRatingPlayer = [];
            $mom = 0;
            $momFirst = [];

            //calculate rating average
            foreach ($playersVote as $key => $player) {
                $arrayRatingPlayer[] = $player->assigned_rating;
                if($player->man_of_match == '1'){
                    if(isset($momFirst[$player->vote_to_player_id])){
                        $momFirst[$player->vote_to_player_id] +=  1;
                    }else{
                        $momFirst[$player->vote_to_player_id] = $mom + 1;
                    }
                }

                //vote_to_player_id
                if(isset($playersVote[$key + 1])){
                    if($playersVote[$key + 1]->vote_to_player_id != $player->vote_to_player_id){
                        //note moyenne
                        $ratingPlayer = array_sum($arrayRatingPlayer) / count($arrayRatingPlayer);
                        $statPlayer = StatsPlayer::find($player->vote_to_player_id);
                        $statPlayer->overall_average = $ratingPlayer;
                        $statPlayer->save();
                        $hatPlayer = HatPlayer::movePlayerHatByCurrentRating($ratingPlayer, $statPlayer->current_rating);
                        DB::beginTransaction();
                            DB::table('hat_players')
                                ->where('player_id', $player->vote_to_player_id)
                                ->update(['hat_id' => $hatPlayer['playerHat'],
                                ])
                            ;
                             DB::table('match_player_rating')
                                 ->updateOrInsert([
                                     'match_id' => $matchId,
                                     'player_id' => $player->vote_to_player_id,
                                     'rating' => round($ratingPlayer, 2)
                                     ])
                             ;
                         DB::commit();
                        $arrayRatingPlayer = [];
                        $mom = 0;

                    }
                }

                //TODO MENTION SPECIALE !!!!!


                //vote_by_user_id
                //man_of_match
                //assigned_rating

            }
            //idManOfMatch
            if(!empty($momFirst)){
                arsort($momFirst);
                $idMoM = array_key_first($momFirst);
                DB::beginTransaction();
                    DB::table('palmares_player')
                        ->updateOrInsert([
                           'date_palmares' => $dataMatch->match_date,
                            'palmares_name' => 'man_of_match',
                            'player_id' => $idMoM,
                            'created_at' => now(),
                            'url_video' => ''
                        ]);
                    DB::table('stats_matchs')
                        ->where('man_of_match', '!=', '0')
                        ->update(['man_of_match' => '0']);
                    DB::table('stats_matchs')
                        ->where('player_id', $idMoM)
                        ->update(['man_of_match' => '1']);
                DB::commit();
            }else{
                DB::table('stats_matchs')
                    ->where('man_of_match', '!=', '0')
                    ->update(['man_of_match' => '0'])
                ;
            }

            //cloturer les votes pour ce match
            DB::table('matchs')
                ->where('id', $matchId)
                ->update(['vote_closed' => '1'])
            ;


            //mettre a jour les notes

            //mentions spéciales

            //mettre a jour palmares


            return response()->json(['ok' => 'votes clos']);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
