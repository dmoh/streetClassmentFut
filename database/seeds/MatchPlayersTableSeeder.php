<?php

use Illuminate\Database\Seeder;
use App\MatchPlayers;
class MatchPlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        MatchPlayers::truncate();

        for($i = 1; $i < 9; ++$i) {
            MatchPlayers::create([
                'match_id' => $i,
                'stats_player_id' => rand(1, 13)
            ]);
        }
    }
}
