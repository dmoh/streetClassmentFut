<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriesRepository;
use App\Repositories\CoachRepository;
use App\Repositories\GroupPlayerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //

        $players = DB::table('group_user')
            ->join('stats_players', 'stats_players.id', '=', 'group_user.id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->leftJoin('uploads', 'uploads.user_id', '=', 'group_user.user_id')
            ->join('player_team', 'player_team.player_id', '=', 'group_user.player_id')
            ->where('player_team.team_id', $id)
            ->get()
            ;

        return view('team/show', compact('players'));

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
