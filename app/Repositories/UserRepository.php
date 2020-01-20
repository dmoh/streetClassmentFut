<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 20/01/2020
 * Time: 11:13
 */
namespace App\Repositories;
use App\User;


class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save($user)
    {
        $this->user->user = $user;
        $this->user->save();
    }


    public function update($request) {

        $user = User::find($request->idUserUpdate);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->surname = $request->surname;
        $user->age = $request->age;

        $user->save();

    }

}