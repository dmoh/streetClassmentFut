<?php

namespace App\Http\Controllers;

use App\Mail\VoteOpen;
use App\Matchs;
use App\Notifications\VoteOpenMessage;
use App\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $vote;
    public function __construct(Votes $vote)
    {
        $this->vote = $vote;
    }

    public function index(Request $request)
    {
        if(Auth::id()){
            // $matchs = Matchs::with('statsPlayer')->get();
            //todo ranger dans un repository
            $matchs = DB::table('matchs')
                ->join('match_players', 'match_players.match_id', '=', 'matchs.id')
                ->join('group_match', 'group_match.match_id', '=', 'matchs.id')
                ->join('stats_players', 'stats_players.player_id', '=', 'match_players.stats_player_id')
                ->select(  'matchs.id', 'matchs.score', 'matchs.match_date', 'matchs.vote_closed')
                ->distinct()
                ->where('stats_players.player_id', '=', Auth::id())
                ->where('group_match.group_id', '=', $request->session()->get('groupId'))
                ->orderBy('matchs.id', 'desc')
                ->limit(5)
                ->get()
            ;
            $playersMatchWithStats = DB::table('stats_matchs')
                ->join('match_players', 'match_players.match_id', '=','stats_matchs.match_id')
                ->join('match_player_rating', 'match_player_rating.match_id', '=','stats_matchs.match_id')
                ->join('stats_players', 'stats_players.id', '=', 'stats_matchs.player_id')
                ->join('users', 'users.id', '=', 'stats_matchs.player_id')
                ->whereIn('stats_matchs.match_id', $matchs->pluck('id')->toArray())
                ->select(
                    'stats_matchs.match_id as match_id',
                    'users.name',
                    'users.surname',
                    'stats_players.id as player_id',
                    'stats_players.man_of_match',
                    'stats_matchs.goals',
                    'stats_matchs.assists',
                    'stats_matchs.player_id',
                    'match_player_rating.rating'
                )
                ->distinct()
                // ->groupBy('stats_players.id')
                ->orderBy('stats_matchs.match_id', 'desc')
                ->get()
            ;
            $playerRating = DB::table('match_player_rating')
                ->whereIn('match_id', $matchs->pluck('id')->toArray())
                ->orderByDesc('match_id')
                ->get();
            return view('FrontEnd/matchs-list', compact('matchs', 'playersMatch', 'playerRating'));
        }
        abort(503);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $players = DB::table('stats_players')
            ->join('group_user', 'group_user.id', '=', 'stats_players.id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->leftJoin('uploads', 'uploads.user_id', '=', 'group_user.user_id')
           // ->where('group_user.group_id', '=', session('groupId'))
            ->where('group_user.group_id', '=', 2)
            ->select('users.*', 'stats_players.*', 'uploads.filename', 'uploads.original_name')
            ->orderBy('stats_players.user_id', 'desc')
            ->get()
        ;
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
            $compoTeam1 = $request->get('compoTeam1');
            $compoTeam2 = $request->get('compoTeam2');
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
                    ->where('resume_closed', '=', false)
                    ->get()
        ;

        if(empty($match->toArray())){
            Session::flash('message', 'Ce match est clos !');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('matchs.list');
        }
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
            ->select('stats_players.goals', 'stats_players.assists', 'stats_players.player_id', 'users.email', 'users.name')
            ->join('users', 'users.id', '=', 'stats_players.user_id')
            ->whereIn('player_id', $arrPlayersId)
            ->orderBy('player_id', 'DESC')
            ->get()
        ;


        foreach ($dataPlayerDb as $playerDb) {
            foreach ($resumeMatch as $player) {
                if((int) $playerDb->player_id == (int) $player['userId']){
                    $sumGoals = $playerDb->goals + $player['goals'];
                    $sumAssists = $playerDb->assists + $player['assists'];
                    if($player['hdm'] == "true") {
                        $player['hdm'] = '1';
                    }else{
                        $player['hdm'] = '0';
                    }
                    DB::table('stats_players')
                        ->where('man_of_match', '!=', '0')
                        ->update(['man_of_match' => '0']);

                    DB::table('stats_players')
                        ->where('player_id', (int) $playerDb->player_id)
                        ->update(
                            [
                            'assists' => $sumAssists,
                            'goals' => $sumGoals,
                            'man_of_match' => $player['hdm']
                            ]
                        )
                    ;



                    DB::table('stats_matchs')
                        ->insert(
                            [
                                'assists' => $player['assists'],
                                'goals' => $player['goals'],
                                'man_of_match' => $player['hdm'],
                                'match_date' => now(),
                                'rating' => 0, // todo check pour la note
                                'manager_user_id' => Auth::id(),
                                'player_id' => $player['userId'],
                                'match_id' => $matchId,
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
                    'updated_at' => now(),
                    'resume_closed' => true
                    //todo date du match,
                ]
            )
        ;

        // todo



        //Send mail to players
       // Mail::to(collect($dataPlayerDb))->send(new VoteOpen());

        //todo generate template mail vote
        Votes::sendMailToVoters('mkanoute74@gmail.com');
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
                ->join('stats_matchs', 'stats_matchs.match_id', '=', 'matchs.id')
                ->join('stats_players', 'match_players.stats_player_id', '=', 'stats_players.player_id')
                ->join('users', 'users.id', '=', 'stats_players.user_id')
                ->select('users.*', 'stats_players.overall_average', 'matchs.match_date', 'matchs.score', 'matchs.vote_closed')
                ->whereIn('matchs.id', $matchs->pluck('id')->toArray())
                ->orderBy('matchs.id', 'desc')
                ->get();
            return view('FrontEnd/matchs-list', compact('matchs', 'playersMatch'));

        }
    }
}
