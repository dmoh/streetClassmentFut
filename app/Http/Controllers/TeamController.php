<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use App\Repositories\CoachRepository;
use App\Repositories\GroupPlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // todo check role user coach or Better
        $groupId = session('groupId');
        $categories = CategoriesRepository::getCategoriesByGroup($groupId);
        $players = GroupPlayerRepository::getPlayersByGroupId($groupId);
        $coachs = CoachRepository::getListPotientalCoachByGroupId($groupId);


        return view('team/create', compact('categories', 'players', 'coachs'));
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
            $datas = $request->request;
            //check if teamName already exist for this group
            $groupId = $datas->get('groupId');
            $coachUserId = $datas->get('coachUserId');
            $catId = $datas->get('catId');
            $playersSelected = $datas->get('playersSelected');
            $teamName = $datas->get('teamName');

            $teamId = DB::table('teams')
                ->insertGetId([
                    'name' => $teamName,
                    'match_id' => 0,
                    'group_id' => $groupId,
                    'created_at' => \now()
                ])
            ;
            sleep(.3);
            DB::table('coach_team')
                ->insert(
                    [
                        'coach_id' => $coachUserId,
                        'team_id' => $teamId,
                        'created_at' => \now()
                    ]
                )
            ;

            if(preg_match('/[0-9]/', $catId)){
                DB::table('category_team')
                    ->insert(
                        [
                            'category_id' => $catId,
                            'team_id' => $teamId,
                            'created_at' => \now()
                        ]
                    )
                ;
            }

            // dd($playersSelected);

            $arrPlayer = explode(',', $playersSelected);
            $arrPlayerSave = [];
            foreach ($arrPlayer as $item) {
               $arrPlayerSave[] = [
                    'player_id' => $item,
                    'team_id' => $teamId,
                    'created_at' => \now()
                ];
            }

            DB::table('player_team')
                ->insert(
                    $arrPlayerSave
                )
            ;

            return response()->json(['ok' => 'success']);
        }
    }

    public function checkNameTeam(Request $request) {

        if($request->ajax()){
            $groupId = session('groupId');

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
        // TODO GET INFO DU SITE FFF DISCTRICT EXEMPLE

        /*$arr =[];
        $imIn = false;
        $request = file('https://hautesavoie-paysdegex.fff.fr/competitions/?id=363428&poule=1&phase=1&type=ch&tab=ranking');
        foreach ($request as $item) {
            $item = rtrim(trim($item),"\n");
            if(preg_match('/<table class="ranking-tab">/', $item)){
                $imIn = true;

            }
            if($imIn == true){
                $arr[] = $item;
            }
            if(preg_match('/<\/table>/', $item)){
                $imIn = false;
            }
        }*/
        $userId = Auth::user()->getAuthIdentifier();
        $teamInfo = DB::table('teams')
                    ->join('coach_team', 'coach_team.team_id', '=', 'teams.id')
                    ->join('users', 'users.id', '=', 'coach_team.coach_id')
                    ->join('category_team', 'category_team.id', '=', 'teams.id')
                    ->leftJoin('categories', 'categories.id', '=', 'category_team.category_id')
                    ->where('coach_team.coach_id', 10)
                    ->where('teams.id', $id)
                    ->select(
                        'teams.*',
                        'users.name as coach_name',
                        'coach_team.*',
                        'categories.name as category_name'
                    )
                    ->get()
        ;

        $players = DB::table('group_user')
            ->join('stats_players', 'stats_players.id', '=', 'group_user.id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->leftJoin('uploads', 'uploads.user_id', '=', 'group_user.user_id')
            ->join('player_team', 'player_team.player_id', '=', 'group_user.player_id')
            ->select(
                'stats_players.*',
                'stats_players.id as stat_real_player_id',
                'users.name',
                'users.surname',
                'uploads.*',
                'player_team.id as line_table_player_team.id'
            )
            ->where('player_team.team_id', $id)
            ->get()
            ;


        return view('team/show', compact('players', 'teamInfo'));

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


    public function deletePlayerTeam(Request $request) {
        if($request->ajax()) {
            $rowIdTeamToDelete = $request->request->get('rowIdTeamToDelete');
            $teamId = $request->request->get('teamId');
            $groupId = $request->request->get('groupId');
            DB::table('player_team')
                ->where('player_id','=', $rowIdTeamToDelete)
               ->where('team_id', '=', $teamId )
                ->delete()
                // ->delete('id', $rowIdTeamToDelete)
            ;
            return response()->json(['ok' => 'success']);
        }
    }

    public function findPlayerName(Request $request) {
        if($request->ajax()){
            $datas = $request->request;
            $teamId = $datas->get('teamId');
            $groupId = $datas->get('groupId');
            $playerName = $datas->get('playerName');
            $playersAvailable = DB::table('group_user')
                            ->join('groups', 'groups.id', '=', 'group_user.group_id')
                            ->join('users', 'users.id', '=', 'group_user.user_id')
                            ->leftJoin('stats_players', 'stats_players.id',  '=', 'group_user.id')
                            // ->join('group_team', 'group_team.group_id', '=', 'group_user.group_id')
                            //->join('player_team', 'player_team.team_id', '=', 'group_team.team_id')
                           // ->where('groups.id', $groupId)
                            ->where('groups.id', 2)
                           // ->where('player_team.team_id', '!=', $teamId)
                           ->where('users.name', 'LIKE', '%'.$playerName.'%')
                           ->orWhere('users.surname', 'LIKE', '%'.$playerName.'%')
                            ->select(
                                'group_user.id as gu_id',
                                'group_user.user_id as real_user_id',
                                'stats_players.*',
                                'users.name',
                                'users.surname',
                                'stats_players.id as stat_player_real_id'
                            )
                           ->get();
            return response()->json(['players' => $playersAvailable]);
        }
    }


    public function addPlayerTeam(Request $request) {
        if($request->ajax()){
          $newPlayer = $request->request;
          $newRowPlayerId=  DB::table('player_team')
                ->insertGetId([
                    'player_id' => $newPlayer->get('addStatPlayerId'),
                    'team_id' => $newPlayer->get('teamId')
                    ])
          ;
          return response()->json(['ok' => $newRowPlayerId]);
        }
    }
}
