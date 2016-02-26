<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionDetailsToTravallyTransactionDetailsTable extends Migration
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
            $table->string('travally_transaction_details_net_amount_debit');
            $table->string('travally_transaction_details_payment_source');
            $table->string('travally_transaction_details_payment_mode');
            $table->string('travally_transaction_details_card_type');
            $table->string('travally_transaction_details_card_num');
            $table->string('travally_transaction_details_bank_ref_number');
            $table->string('travally_transaction_details_bank_code');
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
            $table->dropColumn(['travally_transaction_details_net_amount_debit']);
            $table->dropColumn(['travally_transaction_details_payment_source']);
            $table->dropColumn(['travally_transaction_details_payment_mode']);
            $table->dropColumn(['travally_transaction_details_card_type']);
            $table->dropColumn(['travally_transaction_details_card_num']);
            $table->dropColumn(['travally_transaction_details_bank_ref_number']);
            $table->dropColumn(['travally_transaction_details_bank_code']);
        });
    }
}
