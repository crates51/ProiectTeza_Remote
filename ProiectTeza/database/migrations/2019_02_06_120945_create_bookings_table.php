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
            $table->string('unique_bookingId', 100);
            $table->unsignedBigInteger('clientId')->nullable();
            $table->unsignedBigInteger('roomId')->nullable();

            
            // $table->foreign('clientId')->references('clientId')->on('clients');
                                                               // ->onDelete('cascade');
            $table->string('Status')->default("Status Not inserted");
            $table->string('Adults')->default("Nr. Adults Not inserted");
            $table->string('Children')->default("Nr. Children Not inserted");
            $table->string('totalRooms')->nullable();
            $table->string('Checkin')->default(NULL);
            $table->string('Checkout')->default(NULL); 
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
