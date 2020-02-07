<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palmares extends Model
{
    protected $fillable = [
      'date_palmares', 'palmares_name', 'url_video'
    ];

    protected $primaryKey = 'id';

    public function statsPlayer(){
        return $this->belongsTo(StatsPlayer::class);
    }
}
