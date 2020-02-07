<?php

use Illuminate\Database\Seeder;
use App\GroupPlayer;
class GroupPlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i < 23; ++$i) {
            GroupPlayer::create([
                'player_id' => $i,
                'group_id' => 1,
                'role_id' => 3,
            ]);
        }

        GroupPlayer::create([
            'player_id' => 4,
            'group_id' => 2,
            'role_id' => 3,
        ]);
        GroupPlayer::create([
            'player_id' => 12,
            'group_id' => 2,
            'role_id' => 3,
        ]);


    }
}
