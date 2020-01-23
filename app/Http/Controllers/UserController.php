<?php

namespace App\Http\Controllers;

use App\HatPlayer;
use App\Http\Requests\StatsPlayerUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\StatsPlayerRepository;
use App\StatsPlayer;
use Illuminate\Http\Request;
use App\Upload;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Role;
use Illuminate\Support\Str;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

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

        //todo send by mail

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

        $hatPlayerId = HatPlayer::changePlayerHat($statPlayer->current_rating);

        HatPlayer::create([
            'hat_id' => $hatPlayerId,
            'player_id' => $user->id
        ]);


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
    public function edit(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $statsPlayer = DB::table('stats_players')->where('user_id', implode(',', $user->statPlayer()->get()->pluck('user_id')->toArray()))->first();
        $photo = DB::table('uploads')->where('user_id', $id)->first();

        if($request->session()->has('index')) {
            $request->session()->put('index',  Str::random(30));
        }

        $postes=collect(['ATT', 'BU', 'DEF', 'MDC', 'MOC', 'MG', 'MD']);
        $skills= collect(['VITESSE', 'BUTEUR', 'PASSEUR', 'DRIBBLEUR', 'TECHNIQUE', 'COSTAUD', 'AGRESSIF']);
        $feet = collect(['LEFT', 'RIGHT']);
        return view('FrontEnd/edit-user', compact('user', 'statsPlayer', 'postes', 'skills', 'feet', 'photo' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
       $this->userRepository->update($request);
       return redirect()->route('consultation.showProfile', ['id' => $request->idUserUpdate]);
    }

    public function updateStats(StatsPlayerUpdateRequest $request, StatsPlayerRepository $statsPlayerRepository){

        if($request->session()->has('index')) {
            $index = $request->session()->get('index');
            $userId = (int)$request->request->get('idStatsPlayer');
           $infoPhotoDb =  DB::table('uploads')->where('user_id', $userId )
                ->first();

           if($infoPhotoDb !== null){
               Upload::where('user_id', $userId)->delete();
           }
            Upload::whereIndex($index)->update(['user_id' => $userId, 'index' => 0]);
        }

        $statsPlayerRepository->update($request);
        return redirect()->route('consultation.showProfile', ['id' => $request->idStatsPlayer]);
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
