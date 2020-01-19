<?php

namespace App\Http\Controllers;

use App\StatsPlayer;
use Illuminate\Http\Request;
use App\Upload;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Role;
use Illuminate\Support\Str;

class UserController extends Controller
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
    public function create(Request $request)
    {
        if(!$request->session()->has('index')) {
            $request->session()->put('index',  Str::random(30));
        }

        return view('BackEnd/create-user', compact('userMax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $playerRole = Role::where('name', 'player')->first();
        $statPlayer = new StatsPlayer();
        $user->name = $request->name;
        $user->email = $request->emailUser;
        $user->password = bcrypt('testtest1');// todo generate password and send by mail
        $user->save();

        $user->roles()->attach($playerRole);
        $statPlayer->current_rating       = 85;
        $statPlayer->rating_before_update = 5;
        $statPlayer->overall_average      = 0;
        $statPlayer->goals                = 0;
        $statPlayer->position             = $request->poste_player;
        $statPlayer->pace                 = $request->vitesse;
        $statPlayer->shoot                = $request->tir;
        $statPlayer->passe                = $request->passe;
        $statPlayer->dribble              = $request->dribble;
        $statPlayer->defense              = $request->defense;
        $statPlayer->physique             = $request->physique;
        $statPlayer->user_id              = $user->id;
        $statPlayer->player_id            = $user->id;
        $statPlayer->stats_player_id      = $user->id;

        $statPlayer->save();


        if($request->session()->has('index')) {
            $index = $request->session()->get('index');
            Upload::whereIndex($index)->update(['user_id' => $user->id, 'index' => 0]);
        }

        return redirect()->route('consultation.index');
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
