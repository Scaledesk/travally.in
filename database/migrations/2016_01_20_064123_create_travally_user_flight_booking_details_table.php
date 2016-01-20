<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravallyUserFlightBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *
         */
        Schema::create('travally_user_flight_booking_details', function (Blueprint $table) {
            $table->increments('travally_user_flight_booking_details_id');
            $table->string('travally_user_flight_booking_details_pnr');
            $table->string('travally_user_flight_booking_details_airline');
            $table->string('travally_user_flight_booking_details_booking_id');
            $table->string('travally_user_flight_booking_details_ssr_denied');
            $table->string('travally_user_flight_booking_details_ssr_message');
            $table->string('travally_user_flight_booking_details_prod_type');
            $table->string('travally_user_flight_booking_details_confirmation_no');
            $table->string('travally_user_flight_booking_details_payment_reference_no');
            $table->string('travally_user_flight_booking_details_ref_id');
            $table->string('travally_user_flight_booking_details_status_code');
            $table->string('travally_user_flight_booking_details_status_description');
            $table->string('travally_user_flight_booking_details_status_category');
            $table->string('travally_user_flight_booking_details_source');
            $table->string('travally_user_flight_booking_details_destination');
            $table->string('travally_user_flight_booking_details_departure_date');
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
            /**
             *
             */
        Schema::drop('travally_user_flight_booking_details');

    }
}
