<?php

use Illuminate\Database\Seeder;
use App\Votes;
class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 15; ++$i) {
            Votes::create([
                'date_of_vote' => now(),
                'assigned_rating' => rand(1, 10),
                'vote_by_user_id' => rand(8, 15),
                'vote_to_player_id' => rand(1,7),
                'match_id' => rand(1,8)
            ]);
        }
    }
}
