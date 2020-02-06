<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsPlayer extends Model
{
    //
    protected $primaryKey = 'player_id';

    protected $fillable = [

    ];

    public function user(){
        return $this->belongsTo('App\User', 'player_stat_id');
    }

    public function statsMatchs(){
        return $this->hasMany('App\StatsMatchs', 'player_id');
    }

    public function matchs(){
        return $this->belongsToMany('App\Matchs');
    }

    public function hat(){
        return $this->hasOne('App\Hats', 'hat_id');
    }

    public function specialCapacities(){
        return $this->hasMany(SpecialCapacities::class);
    }

    public function group(){
        return $this->hasMany(Groups::class);
    }

    public static function  getArrayOfPosition(){
      return  collect(['ATT', 'BU', 'DEF', 'MDC', 'MOC', 'MG', 'MD']);
    }

    public static function getArrayOfSkill(){
        return  collect(['VITESSE', 'BUTEUR', 'PASSEUR', 'DRIBBLEUR', 'TECHNIQUE', 'COSTAUD', 'AGRESSIF', 'LEADER', 'MENEUR DE JEU']);
    }

    public static function getArrayOfSpecialMention(){
        return collect([
            'CHEF',
            'DANS UN GRAND SOIR',
            'PLUS BEAU BUT',
            'TOP PERFORMANCE',
            'GRAND LEADER',
            'GRAND ARTISTE',
        ]);
    }




}
