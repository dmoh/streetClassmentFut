<?php
/**
 * Created by PhpStorm.
 * User: UTILISATEUR
 * Date: 31/01/2020
 * Time: 07:59
 */

namespace App\Repositories;


class PalmaresRepository
{
    protected  $palmaresPlayer;

    public function __construct()
    {

    }


    public function save($palmaresPlayer) {
        $this->palmaresPlayer = $palmaresPlayer;
        $this->palmaresPlayer->save();
    }
}