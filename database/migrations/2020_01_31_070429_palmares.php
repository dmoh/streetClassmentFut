<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Palmares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('palmares_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_palmares')->default(now());
            $table->enum('palmares_name',
                [
                    'man_of_match',
                    'top_player',
                    'top_goal',
                    'best_goal',

                ]);
            $table->unsignedBigInteger('match_id');
            $table->dateTime('date_palmares_assigned');
            $table->unsignedBigInteger('player_id');
            $table->string('url_video')->default(null);
            $table->timestamps();

            //foreign key
            $table->foreign('player_id')->references('player_id')->on('stats_players');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
