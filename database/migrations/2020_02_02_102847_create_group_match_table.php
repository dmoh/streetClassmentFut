<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_match', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('match_id');
            $table->dateTime('date_match');
            $table->timestamps();

            //foreign key
            $table->foreign('group_id')->references('id')->on('groups');
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
        Schema::dropIfExists('group_match');
    }
}
