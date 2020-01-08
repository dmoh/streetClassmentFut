<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HatsTableSeeder::class);
        $this->call(VotesTableSeeder::class);
        $this->call(MatchPlayersTableSeeder::class);
        $this->call(MatchsTableSeeder::class);
        $this->call(HatPlayerTableSeeder::class);
        $this->call(StatsMatchsTableSeeder::class);
        $this->call(StatsPlayersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
