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
        Schema::create('palmares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_palmares')->default(now());
            $table->string('palmares_name');
            $table->unsignedBigInteger('match_id');
            $table->dateTime('date_palmares_assigned');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('attributed_by_user_id');
            $table->string('url_video')->default(null);
            $table->timestamps();

            //foreign key
            $table->foreign('player_id')->references('id')->on('group_stat_user');
            $table->foreign('attributed_by_user_id')->references('id')->on('group_stat_user');
            $table->foreign('match_id')->references('id')->on('matchs');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palmares');
    }
}
