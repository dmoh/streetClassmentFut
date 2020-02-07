<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //

    public function statsPlayer(){
        return $this->belongsToMany(StatsPlayer::class);
    }
}
