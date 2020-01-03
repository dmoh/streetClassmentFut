<?php

namespace App\Http\Controllers\FrontEnd;

use App\StatsPlayer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    //

    public function index(){

        $players = User::all();

        return view('FrontEnd/index')->with('players', $players);
    }


    public function showProfile($id) {
        $user = User::findOrFail($id);
        return view('FrontEnd/profile')->with('player', $user);
    }
}
