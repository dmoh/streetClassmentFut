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
        //choisir le groupe si plusieurs
        $groups = DB::table('groups')
        ->select('groups.*', 'group_player.role_id')->distinct()
        ->join('group_player', 'group_player.group_id', '=', 'groups.id')
        ->join('stats_players', 'stats_players.id', '=', 'group_player.player_id')
        ->where('stats_players.user_id', '=', $userId)
        ->orderBy('groups.group_name', 'DESC')
        ->get();
        $request->session()->put('groupId', $groups[0]->id);
        $request->session()->put('groupName', $groups[0]->group_name);

        return view('home', compact('groups'));
    }
}
