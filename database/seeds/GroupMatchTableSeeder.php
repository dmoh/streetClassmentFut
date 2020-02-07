<?php

use Illuminate\Database\Seeder;
use App\GroupMatch;

class GroupMatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i < 21; ++$i) {
            GroupMatch::create([
                'group_id' => rand(1, 2),
                'match_id' => $i,
                'date_match' => now()
            ]);
        }

    }
}
