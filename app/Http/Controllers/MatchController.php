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

            return response()->json(['idMatch' => $newMatchId]);


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
                ->join('stats_players', 'stats_players.user_id', '=', 'match_players.stats_player_id')
                ->join('users', 'users.id', '=', 'stats_players.stats_player_id')
                ->where('match_players.match_id', '=', $id)
                ->orderBy('users.id', 'DESC')
                // ->select('users.name', '')// todo get note globale player
                ->get();


        $allPlayers = DB::table('users')
            ->whereIn('users.id', $players->pluck('stats_player_id')->toArray())
            ->orderBy('users.id', 'DESC')
            ->select('users.name', 'users.id') //Todo rajouter age
            ->get();

        return view('BackEnd/edit-match', compact('match', 'players', 'allPlayers'));
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

    public function resumeMatch(Request $request){
        $matchId = $request->matchId;
        $resumeMatch = $request->resumeMatch;

        $score = $resumeMatch[0]['scoreTeam1'].' - '.$resumeMatch[0]['scoreTeam2'];
        unset($resumeMatch[0]);
        $arrPlayersId = [];
        foreach ($resumeMatch as $dataPlayer) {
            $playerId = $dataPlayer['userId'];
            $arrPlayersId[] = $playerId;
            $hdm = $dataPlayer['hdm']; //todo add var man of the match

        }


        $dataPlayerDb = DB::table('stats_players')
            ->select('goals', 'assists', 'player_id')
            ->whereIn('player_id', $arrPlayersId)
            ->orderBy('player_id', 'DESC')
            ->get();
        foreach ($dataPlayerDb as $playerDb) {
            foreach ($resumeMatch as $player) {
                if((int) $playerDb->player_id == (int) $player['userId']){
                    $sumGoals = $playerDb->goals + $player['goals'];
                    $sumAssists = $playerDb->assists + $player['assists'];
                    DB::table('stats_players')
                        ->where('player_id', (int) $playerDb->player_id)
                        ->update(
                            [
                            'assists' => $sumAssists,
                            'goals' => $sumGoals
                            ]
                        )
                    ;
                    DB::table('stats_matchs')
                        ->insert(
                            [
                                'assists' => $player['assists'],
                                'goals' => $player['goals'],
                                'match_date' => now(),
                                'rating' => rand(1,10), // todo check pour la note
                                'manager_user_id' => Auth::id(),
                                'player_id' => $player['userId'],
                                    //todo date du match,
                            ]
                        )
                    ;

                }
            }
        }

        DB::table('matchs')
            ->where('id', $matchId)
            ->update(
                [
                    'score' => $score,
                    'updated_at' => now()
                    //todo date du match,
                ]
            )
        ;

        // todo

        return response()->json(['ok' => 'match closed']);
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
