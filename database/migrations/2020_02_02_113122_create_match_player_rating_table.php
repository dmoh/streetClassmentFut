<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchPlayerRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_player_rating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('rating');


            //foreign key
            $table->foreign('match_id')->references('id')->on('matchs');
            $table->foreign('player_id')->references('player_id')->on('stats_players');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_player_rating');
    }
}
