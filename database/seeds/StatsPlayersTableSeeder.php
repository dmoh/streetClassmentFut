<?php

use Illuminate\Database\Seeder;
use App\StatsPlayer;
class StatsPlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        StatsPlayer::truncate();

        $arrRand= array('ATT', 'BU', 'DEF', 'MDC', 'MOC', 'MG', 'MD');
        $skillRand= array('VITESSE', 'BUTEUR', 'PASSEUR', 'DRIBBLEUR', 'TECHNIQUE', 'COSTAUD', 'AGRESSIF');

        for($i = 1; $i < 13; ++$i){

            StatsPlayer::create([
                'id' => $i,
                'rating_before_update' => 5,
                'overall_average' => 5,
                'goals' => 0,
                'assists' => 0,
                'created_at' => now(),
                'user_id' => $i,
                'player_id' => $i,
                'stats_player_id' => $i,
                'current_rating' => rand(80, 97),
                'position' => $arrRand[rand(0,6)],
                'pace'  => rand(75, 97),
                'shoot' => rand(85, 97),
                'passe' => rand(85, 97),
                'dribble'          => rand(75, 90),
                'defense'         => rand(75, 90),
                'physique'         => rand(75, 90),
                'skill'         => $skillRand[rand(0,6)],
            ]);
        }


        StatsPlayer::create([
            'id' => $i,
            'rating_before_update' => 5,
            'overall_average' => 5,
            'goals' => 0,
            'assists' => 0,
            'created_at' => now(),
            'user_id' => $i,
            'player_id' => $i,
            'stats_player_id' => $i,
            'current_rating' => rand(80, 97),
            'position' => $arrRand[rand(0,6)],
            'pace'  => rand(75, 97),
            'shoot' => rand(85, 97),
            'passe' => rand(85, 97),
            'legend' => '1',
            'dribble'          => rand(75, 90),
            'defense'         => rand(75, 90),
            'physique'         => rand(75, 90),
            'skill'         => $skillRand[rand(0,6)],
            'user_id'          =>  $i,
            'player_id'        =>  $i,
            'stats_player_id'  =>  $i
        ]);



    }
}
