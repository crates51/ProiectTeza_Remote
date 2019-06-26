<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('First_Name')->default("Prenume Neintrodus");
            $table->string('Last_Name')->default("Nume Familie Neintrodus");
            $table->string('Email')->default("Email Neintrodus");
            $table->string('Adults')->default("Nr. Adults Neintrodus");
            $table->string('Children')->default("Nr. Copii Neintrodus");
            $table->string('Rooms')->default("Nr. Camere Neintrodus");
            $table->mediumText('Message');
            $table->increments('id');
            // $table->date('Check_in')->default('00-00-000');
            // $table->date('Check_out')->default('00-00-000');
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
        Schema::dropIfExists('bookings');
    }
}
