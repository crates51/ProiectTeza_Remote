<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('playerid');
            $table->string('First_Name')->default("First Name Not inserted");
            $table->string('Last_Name')->default("Last Name Not inserted");
            $table->integer('Rank')->default(0);
            $table->integer('Experience')->default(0);
            $table->string('Last_Played')->default(NULL);
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
        Schema::dropIfExists('players');
    }
}
