<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravalllyCancellationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travally_cancellation_details', function (Blueprint $table) {
            $table->increments('travally_cancellation_details_id');
            $table->string('travally_cancellation_details_type');
            $table->string('travally_cancellation_details_status');
            $table->string('travally_cancellation_details_cancellation_id');
            $table->string('travally_cancellation_details_cancellation_tax_no');
            $table->string('travally_cancellation_details_cancellation_charge');
            $table->float('travally_cancellation_details_refund_amount');
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
        Schema::drop('travally_cancellation_details');
    }
}
