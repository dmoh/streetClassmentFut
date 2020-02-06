<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 02/02/2020
 * Time: 11:48
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class GroupsRepository
{

    public function __construct()
    {
    }


    public final static function getAllGroups(){
        return DB::table('groups')
                ->get()
            ;
    }
}