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
            $table->integer('current_rating')->default(0);
            $table->integer('rating_before_update')->nullable();
            $table->integer('overall_average')->nullable(); //moyenne générale
            $table->integer('goals')->nullable();
            $table->integer('position')->nullable(); //Passe décisive
            $table->integer('pace')->nullable(); //Vitesse
            $table->integer('shoot')->nullable(); //Passe décisive
            $table->integer('passe')->nullable(); //Passe décisive
            $table->integer('dribble')->nullable(); //Passe décisive
            $table->integer('defense')->nullable(); //Passe décisive
            $table->integer('physique')->nullable(); //Passe décisive
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
