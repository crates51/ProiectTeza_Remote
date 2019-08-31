<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('roomId');
            $table->unsignedBigInteger('floorId')->nullable();
            $table->integer('nrOfBeds')->nullable();
            $table->boolean('seaSight')->default(false);
            $table->boolean('available')->default(true);
            $table->longText('2019')->nullable();
            $table->longText('2020')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
