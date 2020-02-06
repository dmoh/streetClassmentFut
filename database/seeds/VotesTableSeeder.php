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
        for($i = 1; $i < 23; ++$i) {
            Votes::create([
                'date_of_vote' => now(),
                'assigned_rating' => rand(1, 10),
                'vote_by_user_id' => rand(1, 5),
                'vote_to_player_id' => rand(6, 11),
                'group_id' => rand(1,2),
                'match_id' => rand(1,11)
            ]);
        }
    }
}
