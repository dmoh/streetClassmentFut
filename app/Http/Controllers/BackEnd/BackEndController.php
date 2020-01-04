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
            $matchsByPlayer = StatsPlayer::with('statsMatchs')->where('player_id', 1)->get();
            return view('BackEnd/vote')->with('matchs', $matchsByPlayer);
        }

        return route('home');

    }
}
