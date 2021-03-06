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
        $this->call(GroupPlayerTableSeeder::class);
        $this->call(GroupMatchTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(MatchPlayersTableSeeder::class);
        $this->call(MatchsTableSeeder::class);
        $this->call(StatsMatchsTableSeeder::class);
        $this->call(StatsPlayersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HatPlayerTableSeeder::class);
    }
}
