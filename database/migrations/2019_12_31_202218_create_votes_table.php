<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->dateTime('date_of_vote');
            $table->integer('assigned_rating'); // note attribuée
            $table->unsignedBigInteger('vote_by_user_id');
            $table->unsignedBigInteger('vote_to_player_id');
            $table->longText('comment_by_voter')->nullable();
            $table->foreign('vote_by_user_id')->references('id')->on('users');
            $table->foreign('vote_to_player_id')->references('id')->on('users');
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
        Schema::dropIfExists('votes');
    }
}
