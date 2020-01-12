<?php

namespace App\Http\Controllers;

use App\Matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::id()){
            // $matchs = Matchs::with('statsPlayer')->get();

            //todo ranger dans un repository
            $matchs = DB::table('matchs')
                ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
                ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
                ->join('users', 'users.id', '=', 'stats_players.player_id')
                ->select('users.name',  'matchs.id', 'matchs.score', 'matchs.match_date')
                ->where('users.id', '=', 7)
                ->orderBy('matchs.id')
                ->get();
            $playersMatch = DB::table('matchs')
                ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
                ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
                ->join('users', 'users.id', '=', 'stats_players.user_id')
                ->whereIn('matchs.id', $matchs->pluck('id')->toArray())
                ->select('users.*', 'stats_players.*', 'matchs.*')
                ->orderBy('matchs.id', 'desc')
                ->get();

            return view('FrontEnd/matchs-list', compact('matchs', 'playersMatch'));
        }
        abort(503);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = DB::table('stats_players')
            ->join('users', 'users.id', '=', 'stats_players.user_id')
            ->select('users.*', 'stats_players.*')
            ->orderBy('stats_players.user_id', 'desc')
            ->get();
        return view('BackEnd/create-match', compact('players'));
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

        if($request->ajax()){
            $players = $request->get('players');
             $newMatchId = DB::table('matchs')
               ->insertGetId(['match_date'=> now()]);

             $allPlayers = [];
            foreach ($players as $teams) {
                foreach ($teams as $player) {
                    $allPlayers[] = [
                        'match_id' => $newMatchId,
                        'stats_player_id' => $player['playerid'],
                        'voted' => false,
                        'created_at' => now()
                    ];


                }
            }

            DB::table('match_players')
                ->insert($allPlayers);

            return redirect()->route('show.match', ['id' => $newMatchId]);


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = DB::table('matchs')
                    ->select("matchs.*")
                    ->where('id', '=', $id)
                    ->get()
                ;
        $players = DB::table('match_players')
                ->join('matchs', 'matchs.id', '=', 'match_players.match_id')
                ->join('stats_players', 'stats_players.id', '=', 'stats_players.stats_player_id')
                ->join('users', 'users.id', '=', 'stats_players.id')
                ->select('users.*', 'stats_players.*', 'matchs.*')
                ->where('matchs.id', '=', $id)
                ->get();


        return view('BackEnd/edit-match', compact('match', 'players'));
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

    public function matchsList(){
        if(Auth::id()){
            $matchs = DB::table('matchs')
                ->select( 'matchs.id', 'matchs.score', 'matchs.match_date')
                ->distinct()
                ->orderBy('matchs.id', 'desc')
                ->get();

            $playersMatch = DB::table('matchs')
                ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
                ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
                ->join('users', 'users.id', '=', 'stats_players.user_id')
                ->select('users.*', 'stats_players.*', 'matchs.*')
                ->whereIn('matchs.id', $matchs->pluck('id')->toArray())
                ->orderBy('matchs.id', 'desc')
                ->get();
            return view('FrontEnd/matchs-list', compact('matchs', 'playersMatch'));

        }
    }
}
