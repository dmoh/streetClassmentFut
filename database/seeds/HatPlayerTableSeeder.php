<?php

use Illuminate\Database\Seeder;
use App\HatPlayer;
class HatPlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        HatPlayer::truncate();

        sleep(2);
        $players = DB::table('stats_players')
            ->select('stats_players.player_id', 'stats_players.current_rating', 'stats_players.legend')
            ->orderBy('stats_players.current_rating', 'desc')
            ->get();
        $players->toArray();




        foreach ($players  as $player) {


            if((int)$player->current_rating > 88){
                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 1
                ]);

            }elseif ((int)$player->current_rating <= 88
                &&(int)$player->current_rating > 85
            ){

                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 2
                ]);
            }elseif ((int)$player->current_rating <= 85
                &&(int)$player->current_rating > 75){
                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 3
                ]);

            }elseif ((int)$player->current_rating <= 75){
                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 4
                ]);

            }


            if($player->player_id == 8){
                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 100
                ]);
            }

            if( $player->legend == 1){
                HatPlayer::create([
                    'player_id' => $player->player_id ,
                    'hat_id' => 100
                ]);
            }
        }


    }
}
