<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTxnIdToTravallyTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travally_transaction_details', function (Blueprint $table) {
            //
            $table->string('travally_transaction_details_txn_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travally_transaction_details', function (Blueprint $table) {
            //
            $table->dropColumn(['travally_transaction_details_txn_id']);
        });
    }
}
