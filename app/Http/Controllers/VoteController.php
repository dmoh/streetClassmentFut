<?php

namespace App\Http\Controllers;

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

        // getAllplayersWhichPlayWithMe

        return view('FrontEnd/vote', compact('matchs', 'playersMatch', 'votes' ));


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

            //insert
            foreach ($notes as $note) {
                DB::table('votes')
                    ->updateOrInsert([
                        'date_of_vote' => now(),
                        'assigned_rating' => $note['scoreAwarded'],
                        'vote_by_user_id' => Auth::id(), //todo check if is user current
                        'vote_to_player_id' => $note['voteToPlayerId'],
                        'match_id' => $matchId,
                    ])
                ;
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
