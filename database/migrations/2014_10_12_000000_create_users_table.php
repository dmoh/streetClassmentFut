<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('surname')->default('Joueur');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('adress')->nullable();
            $table->integer('age')->nullable();
            $table->integer('enabled')->default(false);
            $table->string('url_img')->nullable();
            $table->boolean('can_vote')->default('0');
            $table->boolean('locked')->default('0');
            $table->dateTime('expire')->nullable();
            $table->unsignedBigInteger('player_stat_id')->default(0);
            $table->foreign('player_stat_id')->references('user_id')->on('stats_players');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
