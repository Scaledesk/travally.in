<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceValueToFlightBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('travally_user_flight_booking_details', function ($table) {
            $table->integer('travally_user_flight_booking_details_source_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('travally_user_flight_booking_details', function ($table) {
            $table->dropColumn(['travally_user_flight_booking_details_source_value']);
        });
    }
}
