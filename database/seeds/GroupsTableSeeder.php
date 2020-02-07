<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Groups::create([
            'id' => 1,
            'group_name' => 'OFC-VENDREDI'
        ]);

        \App\Groups::create([
            'id' => 2,
            'group_name' => 'QUARTIER'
        ]);
    }
}
