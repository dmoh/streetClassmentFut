<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\StatsPlayer;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $playerRole = Role::where('name', 'player')->first();
        $managerRole = Role::where('name', 'manager_content')->first();



        $admin = User::create([
            'name' => 'MohK',
            'email' => 'mkanoute74@gmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'Moh',
            'can_vote' => '1',
            'locked' => '0'
        ]);
        $player= User::create([
            'name' => 'MohPlayer',
            'email' => 'mkanoute@gmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'MohPlayer1',
            'can_vote' => '1',
            'locked' => '0'
        ]);
        $managerContent = User::create([
            'name' => 'MohManager',
            'email' => 'mk@gmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'MohManager1',
            'can_vote' => '1',
            'locked' => '0'
        ]);

        for($i = 4; $i < 10; ++$i)
        {
            $users = User::create([
                'name' => 'Nom' . $i,
                'email' => 'email' . $i . '@blop.fr',
                'password' => bcrypt('password' . $i),
                'can_vote' => '1',
                'locked' => '0'
            ]);

        }
        $admin->roles()->attach($adminRole);
        $player->roles()->attach($playerRole);
        $managerContent->roles()->attach($managerRole);

    }
}
