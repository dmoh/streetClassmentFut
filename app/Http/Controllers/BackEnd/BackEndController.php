<?php

namespace App\Http\Controllers\BackEnd;

use App\StatsMatchs;
use App\StatsPlayer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackEndController extends Controller
{
    //

    public function showVote(){
        $id = Auth::id();
        if($id != null){
            $matchs = StatsPlayer::with('statsMatchs')->where('player_id', 7)->get();
            return view('BackEnd/vote', compact('matchs'));
        }

        return route('home');

    }
}
