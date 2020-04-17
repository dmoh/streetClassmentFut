<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_match')->default(\now());
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->string('name_team')->default(null);
            $table->timestamps();

            $table->foreign('match_id')->references('id')
                ->on('matchs')
            ;
            $table->foreign('created_by_user_id')->references('id')
                ->on('group_stat_user')
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
        Schema::dropIfExists('convocations');
    }
}
