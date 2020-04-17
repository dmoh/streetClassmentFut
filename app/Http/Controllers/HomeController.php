<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $groups = DB::table('groups')
            ->join('group_user', 'group_user.group_id', '=', 'groups.id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'group_user.role_id')
            ->where('users.id', $userId)
            ->get()
        ;




      //  dd($groups);



        //choisir le groupe si plusieurs
        /*$groups = DB::table('groups')


        ->select('groups.*', 'group_player.role_id')->distinct()
        ->join('group_player', 'group_player.group_id', '=', 'groups.id')
        ->join('stats_players', 'stats_players.id', '=', 'group_player.player_id')
        ->where('stats_players.user_id', '=', $userId)
        ->orderBy('groups.group_name', 'DESC')
        ->get();*/
        if(!$request->session()->exists('groupName')){
            $request->session()->put('groupId', $groups[0]->id);
            $request->session()->put('groupName', $groups[0]->group_name);
        }

        //todo player TEAM !!!!!!!!!!
        $groupId = session('groupId');
        $teams = DB::table('teams')
            ->join('coach_team', 'coach_team.team_id', '=', 'teams.id')
            ->where('coach_team.coach_id', 10)
           // ->where('coach_team.coach_id', $userId)
            ->get()
        ;




        return view('home', compact('groups', 'teams'));
    }
}
