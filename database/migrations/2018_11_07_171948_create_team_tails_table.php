<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_tails', function (Blueprint $table) {
            $table->unsignedInteger('team_id');
            $table->string('class');

            $table->multiLineString('linestring');

            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->primary('team_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_tails');
    }
}
