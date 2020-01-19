<?php

use Illuminate\Database\Seeder;
use App\Matchs;
class MatchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Matchs::truncate();
        for($i = 1; $i < 12; ++$i) {

            Matchs::create([
                'id' => $i,
                'score' => rand(2,20).' - '.rand(4,35),
            ]);
        }
    }
}
