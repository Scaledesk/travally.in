<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('travally_user_bus_booking_details', function (Blueprint $table) {
            $table->increments('travally_user_bus_booking_details_id');
            $table->string('travally_user_bus_booking_details_ticket_no');
            $table->string('travally_user_bus_booking_details_status');
            $table->string('travally_user_bus_booking_details_travel_operator');
            $table->string('travally_user_bus_booking_details_travel_operator_pnr');
            $table->string('travally_user_bus_booking_details_description');
            $table->string('travally_user_bus_booking_details_source');
            $table->string('travally_user_bus_booking_details_destination');
            $table->string('travally_user_bus_booking_details_departure_date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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

        Schema::drop('travally_user_bus_booking_details');
    }
}
