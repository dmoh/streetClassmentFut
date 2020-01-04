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
            $table->integer('assists')->nullable(); //Passe décisive
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->unsignedBigInteger('player_id'); //foreign key


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('player_id')->references('player_id')->on('stats_matchs');

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
