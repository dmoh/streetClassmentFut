<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialCapacities extends Model
{
    protected $fillable = [
        'mention_name',
        'date_mnetion'
    ];
    //

    protected  $primaryKey = 'id';

    public function __construct()
    {

    }

    public function statsPlayer(){
        return $this->belongsTo(StatsPlayer::class);
    }
}
