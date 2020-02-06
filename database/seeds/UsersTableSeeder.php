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
            'name' => 'MOHK',
            'email' => 'mkanoute74@gmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'Moh',
            'can_vote' => '1',
            'age' => 31,
            'locked' => '0'
        ]);
        $admin2 = User::create([
            'name' => 'BALIGH',
            'email' => 'medinibaligh.a@hotmail.fr',
            'password' => bcrypt('testtest'),
            'surname' => 'SUPER BALIGH',
            'can_vote' => '1',
            'age' => 31,
            'locked' => '0'
        ]);
        $admin3 = User::create([
            'name' => 'ANIS',
            'email' => 'anis.hemissi@gmail.com ',
            'password' => bcrypt('testtest'),
            'surname' => 'LA VAMEUHH',
            'can_vote' => '1',
            'age' => 31,
            'locked' => '0'
        ]);
        $player = User::create([
            'name' => 'SOFIAN',
            'email' => 'sofian_a@hotmail.fr',
            'password' => bcrypt('testtest'),
            'surname' => 'SOF',
            'can_vote' => '1',
            'age' => 33,
            'locked' => '0'
        ]);
        $managerContent1= User::create([
            'name' => 'MAMEDY',
            'email' => 'camara_ousman@hotmail.fr ',
            'password' => bcrypt('testtest'),
            'surname' => 'MAMS',
            'can_vote' => '1',
            'age' => 32,
            'locked' => '0'
        ]);
        $player3 = User::create([
            'name' => 'NADIR',
            'email' => 'abouseyana@hotmail.com ',
            'password' => bcrypt('testtest'),
            'surname' => 'TONTON NAD',
            'can_vote' => '1',
            'age' => 27,
            'locked' => '0'
        ]);
        $player4 = User::create([
            'name' => 'BOULAYE',
            'email' => 'boulaye@hotmail.com', //todo changer mail
            'password' => bcrypt('testtest'),
            'surname' => 'MESSI',
            'can_vote' => '1',
            'age' => 33,
            'locked' => '0'
        ]);
        $player6 = User::create([
            'name' => 'AROUNA',
            'email' => 'arouna@hotmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'LEWANDOSKI',//todo changer mail
            'can_vote' => '1',
            'age' => 31,
            'locked' => '0'
        ]);
        $player7 = User::create([
            'name' => 'SOFIAN.K',
            'email' => 'sofian.khadir@hotmail.fr',
            'password' => bcrypt('testtest'),
            'surname' => 'KHADIR',//todo changer mail
            'can_vote' => '1',
            'age' => 28,
            'locked' => '0'
        ]);
        $player10 = User::create([
            'name' => 'NAIM',
            'email' => 'naim@hotmail.com ',
            'password' => bcrypt('testtest'),
            'surname' => 'NAIM.K',//todo changer mail
            'can_vote' => '1',
            'age' => 28,
            'locked' => '0'
        ]);
        $player11 = User::create([
            'name' => 'LAMINE',
            'email' => 'lamine.traore2019@yahoo.com ',
            'password' => bcrypt('testtest'),
            'surname' => 'LAM',//todo changer mail
            'can_vote' => '1',
            'age' => 24,
            'locked' => '0'
        ]);
        $managerContent = User::create([
            'name' => 'SANKOU',
            'email' => 'sankoukanoute@gmail.com',
            'password' => bcrypt('testtest'),
            'surname' => 'KOUS',
            'can_vote' => '1',
            'age' => 34,
            'locked' => '0'
        ]);

        $playerLegend = User::create([
            'name' => 'Bruno',
            'email' => 'bruno.boumeriche@yahoo.com ',
            'password' => bcrypt('testtest1'),
            'surname' => '',//todo changer mail
            'can_vote' => '1',
            'age' => 45,
            'locked' => '0'
        ]);

        /*for($i = 4; $i < 18; ++$i)
        {
            $users = User::create([
                'name' => 'Nom' . $i,
                'email' => 'email' . $i . '@blop.fr',
                'password' => bcrypt('password' . $i),
                'can_vote' => '1',
                'locked' => '0'
            ]);

            $users->roles()->attach($playerRole);

        }*/
        $admin->roles()->attach($adminRole);
        $admin2->roles()->attach($adminRole);
        $admin3->roles()->attach($adminRole);
        $player->roles()->attach($playerRole);
        $player3->roles()->attach($playerRole);
        $player7->roles()->attach($playerRole);
        $player10->roles()->attach($playerRole);
        $player11->roles()->attach($playerRole);
        $player4->roles()->attach($playerRole);
        $player6->roles()->attach($playerRole);
        $managerContent->roles()->attach($managerRole);
        $managerContent1->roles()->attach($managerRole);
        $playerLegend->roles()->attach($playerRole);

    }
}
