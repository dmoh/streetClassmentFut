<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 02/01/2020
 * Time: 13:53
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user(){
        return $this->hasOne('App\User');
    }
}