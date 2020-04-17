<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 13/04/2020
 * Time: 17:57
 */

namespace App\Repositories;
use Illuminate\Support\Facades\DB;


class CategoriesRepository
{

    public static final function getCategoriesByGroup($groupId) {
        return DB::table('categories')
            // ->where('id', $groupId)
             ->where('group_id', $groupId)
             ->orderByDesc('id')
            ->get()
            ;

    }
}