<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('game_client_id')->nullable();

            $table->point('location');

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_client_id')->references('id')->on('game_clients');

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
        Schema::dropIfExists('team_locations');
    }
}
