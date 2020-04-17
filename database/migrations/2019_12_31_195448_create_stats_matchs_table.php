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
            $table->dateTime('date_match');
            $table->integer('goals');
            $table->integer('assists');
            $table->integer('rating'); // note du joueur
            $table->boolean('man_of_match')->default(false); // note du joueur

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('manager_user_id');
            $table->unsignedBigInteger('match_id');


            $table->foreign('player_id')->references('id')
                ->on('group_stat_user')->onDelete('restrict');
            $table->foreign('match_id')->references('id')
                ->on('matchs')->onDelete('restrict');
            $table->foreign('manager_user_id')->references('id')
                ->on('group_stat_user');

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
