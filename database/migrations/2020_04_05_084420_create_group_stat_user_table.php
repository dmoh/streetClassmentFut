<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupStatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_stat_user', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement(); //
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('player_stat_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            $table->foreign('group_id')->references('id')
                ->on('groups');
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('player_stat_id')->references('id')
                ->on('players_stats');
            $table->foreign('role_id')->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_stat_user');
    }
}
