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


        for($i = 1; $i < 10; ++$i){
            StatsPlayer::create([
                'user_id' => $i,
                'rating_before_update' => rand(1, 14),
                'overall_average' => rand(1,10),
                'goals' => rand(1, 134),
                'assists' => rand(2,173),
                'created_at' => now()
            ]);
        }




    }
}
