<?php

use Illuminate\Database\Seeder;
use App\Hats;
class HatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Hats::truncate();

        for ($i = 1; $i < 5; ++$i) {
            Hats::create([
                'id' => $i,
                'name_hat' => 'Elite_' . $i,
                'hat_number' => $i
            ]);
        }


        Hats::create([
            'id' => 100,
            'name_hat' => 'Legend_100',
            'hat_number'=> 100
        ]);
    }
}
