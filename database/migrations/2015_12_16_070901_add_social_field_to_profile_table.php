<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialFieldToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // added column to travally_profile table
        Schema::table('travally_profiles', function ($table) {
            $table->string('social_auth_provider_access_token',500);
            $table->string('social_auth_provider',50);
            $table->string('social_auth_provider_id',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop column of travally_profile table
        Schema::table('travally_profiles', function ($table) {
            $table->dropColumn(['social_auth_provider_access_token', 'social_auth_provider', 'social_auth_provider_id']);
        });
    }
}
