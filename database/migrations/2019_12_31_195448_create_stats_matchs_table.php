<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_matchs', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->dateTime('match_date');
            $table->integer('goals');
            $table->integer('assists');
            $table->integer('rating'); // note du joueur
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('manager_user_id');

            $table->foreign('player_id')->references('user_id')->on('stats_players')->onDelete('restrict');
            $table->foreign('manager_user_id')->references('id')->on('users');

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
        Schema::dropIfExists('stats_matchs');
    }
}
