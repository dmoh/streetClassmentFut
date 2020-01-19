<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('score')->nullable();
            $table->dateTime('match_date')->default(now());
            $table->boolean('resume_closed')->default(false);
            $table->string('team_name_home')->default('Rouge');
            $table->string('team_name_visitor')->default('Bleu');

            $table->foreign('id')->references('match_id')->on('match_players')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('matchs');
    }
}
