<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravallyTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('travally_transaction_details', function (Blueprint $table) {
            $table->increments('travally_transaction_details_id');
            $table->string('travally_transaction_details_type');
            $table->string('travally_transaction_details_status');
            $table->float('travally_transaction_details_amount');
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
        //
        Schema::drop('travally_transaction_details');
    }
}
