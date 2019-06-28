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
            $table->increments('bookingId');
            $table->unsignedBigInteger('clientId')->nullable();
            $table->unsignedBigInteger('roomId')->nullable();
            
            // $table->foreign('clientId')->references('clientId')->on('clients');
                                                               // ->onDelete('cascade');
            $table->string('Status')->default("Status Not inserted");
            // $table->string('First_Name')->default("First Name Not inserted");
            // $table->string('Last_Name')->default("Last Name Not inserted");
            // $table->string('Email')->default("Email Not inserted");
            // $table->string('Phone')->default("Phone Not inserted"); 
            $table->string('Adults')->default("Nr. Adults Not inserted");
            $table->string('Children')->default("Nr. Children Not inserted");
            $table->string('totalRooms')->nullable()    ;
            $table->date('Checkin')->default(NULL);
            $table->date('Checkout')->default(NULL); 
            // $table->mediumText('Message');
            $table->timestamps();
        });

        // Schema::table('bookings', function (Blueprint $table) {
            // $table->foreign('clientId')->references('clientId')->on('clients');
        // });
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
