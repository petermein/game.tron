<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('os', \App\Enums\DeviceOS::toArray());
            $table->string('version')->nullable();

            $table->unsignedInteger('user_id');
            $table->text('device_token');

            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('last_contact')->nullable();
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
        Schema::dropIfExists('game_clients');
    }
}
