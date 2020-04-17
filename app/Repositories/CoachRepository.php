<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 15/04/2020
 * Time: 20:32
 */

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class CoachRepository
{
    public static final function getListPotientalCoachByGroupId($groupId) {
        return  DB::table('group_user')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->join('groups', 'groups.id', '=', 'group_user.group_id')
            ->join('roles', 'roles.id', '=', 'group_user.role_id')
            ->leftJoin('uploads', 'uploads.user_id', '=', 'group_user.user_id')
            ->where('group_user.group_id', $groupId)
            ->where('group_user.role_id', '<', 6)
            ->select(
                'users.name',
                'group_user.id as gu_id',
                'groups.group_name',
                'uploads.*',
                'group_user.*',
                'users.id as user_real_id'
            )
            ->get()
        ;

    }

}