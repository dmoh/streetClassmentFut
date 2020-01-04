<?php

use Illuminate\Database\Seeder;
use App\StatsMatchs;
class StatsMatchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //[

        StatsMatchs::truncate();
        for($i = 1; $i < 8; ++$i) {
            StatsMatchs::create([
               'id' => $i+1,
                'player_id' => $i,
                'match_date' => now(),
                'manager_user_id' => 4,
                'rating' => rand(2, 9),
                'assists' => rand(3, 23),
                'goals' => rand(0, 13)
            ]);
        }
    }
}
