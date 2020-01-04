<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hats', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name_hat')->nullable();
            $table->integer('hat_number');
            $table->unsignedBigInteger('hat_id')->default(0);
            $table->foreign('hat_id')->references('hat_id')->on('hat_player');
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
        Schema::dropIfExists('hats');
    }
}
