<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_players', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->integer('current_rating')->default(75);
            $table->integer('rating_before_update')->nullable();
            $table->integer('assists')->nullable(); //moyenne générale
            $table->float('overall_average')->nullable(); //moyenne générale
            $table->integer('goals')->nullable();
            $table->string('position')->nullable();
            $table->integer('pace')->nullable(); //vitesse
            $table->integer('shoot')->nullable();
            $table->integer('passe')->nullable();
            $table->integer('dribble')->nullable();
            $table->integer('defense')->nullable();
            $table->integer('physique')->nullable();
            $table->string('skill')->nullable(); //point fort
            $table->enum('strong_foot', ['left', 'right'])->default('right'); //Passe décisive


            $table->unsignedBigInteger('user_id'); //foreign key
            $table->unsignedBigInteger('player_id'); //foreign key
            $table->unsignedBigInteger('stats_player_id'); //foreign key


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('player_id')->references('player_id')->on('stats_matchs');
            $table->foreign('stats_player_id')->references('player_id')->on('match_players');

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
        Schema::dropIfExists('stats_players');
    }
}
