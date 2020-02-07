<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');


            //foreign key
            $table->foreign('player_id')
                ->references('player_id')
                ->on('stats_players');
            $table->foreign('group_id')
                ->references('group_id')
                ->on('groups');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');



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
        Schema::dropIfExists('group_player');
    }
}
