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
            $table->dateTime('date_of_vote')->default(now());
            $table->boolean('man_of_match')->default(false);
            $table->enum('special_mention', [
                [
                    'man_of_match',
                    'top_player',
                    'top_goal',
                    'best_goal'
                ]
            ])->default(null);
            $table->integer('assigned_rating'); // note attribuée
            $table->unsignedBigInteger('vote_by_user_id');
            $table->unsignedBigInteger('vote_to_player_id');
            $table->longText('comment_by_voter')->nullable();
            $table->unsignedBigInteger('match_id');
            // $table->unsignedBigInteger('group_id');

            $table->foreign('match_id')->references('id')->on('matchs');
            $table->foreign('vote_by_user_id')->references('id')->on('group_stat_user');
            $table->foreign('vote_to_player_id')->references('id')->on('group_stat_user');
            // $table->foreign('group_id')->references('id')->on('groups');

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
