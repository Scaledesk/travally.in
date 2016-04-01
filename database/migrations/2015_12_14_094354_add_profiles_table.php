<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create table travally profiles
        Schema::create('travally_profiles', function (Blueprint $table) {
            $table->increments('travally_profiles_id');
            $table->integer('travally_profiles_user_id')->unsigned();
            $table->foreign('travally_profiles_user_id')->references('id')->on('users');
            $table->string('travally_profiles_name', 300);
            $table->string('travally_profiles_address',500);
            $table->date('travally_profiles_dob');
            $table->string('travally_profiles_image',1000);
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
        // drop table travally profiles
        Schema::drop('travally_profiles');
    }
}
