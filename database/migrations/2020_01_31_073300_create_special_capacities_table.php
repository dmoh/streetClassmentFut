<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialCapacitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_capacities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mention_name');
            $table->unsignedBigInteger('player_id');
            $table->dateTime('date_mention')->default(now());
            //foreign key
            $table->foreign('player_id')
                    ->references('player_id')
                    ->on('stats_players');
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
        Schema::dropIfExists('special_capacities');
    }
}
