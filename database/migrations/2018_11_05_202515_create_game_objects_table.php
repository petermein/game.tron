<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('class'); //for display purposes

            $table->text('description')->nullable();
            $table->string('geo_type');
            $table->geometry('geo_object');

            $table->boolean('active');
            $table->timestamp('visible_from')->nullable();
            $table->timestamp('visible_till')->nullable();

            $table->json('settings')->nullable();

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
        Schema::dropIfExists('game_objects');
    }
}
