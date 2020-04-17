<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('match_id')->unique();
            $table->string('name')->unique();
            $table->integer('goals');
            $table->timestamps();
            $table->unsignedBigInteger('category_id')
                ->default(0);
            $table->foreign('match_id')->references('id')
                ->on('matchs')
            ;
            $table->foreign('category_id')->references('id')
                ->on('categories');
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
