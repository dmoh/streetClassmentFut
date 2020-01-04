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
        for($i = 1; $i < 10; ++$i) {
            HatPlayer::create([
                'player_id' => $i,
                'hat_id' => rand(1, 4)
            ]);
        }

    }
}
