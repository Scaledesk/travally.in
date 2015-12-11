<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create advertisement table
        Schema::create('travally_advs', function (Blueprint $table) {
            $table->increments('travally_advs_id');
            //$table->primary('id');
            $table->string('travally_advs_img_url', 300);
            $table->string('travally_advs_url',500);
            $table->string('travally_advs_desc',1000);
            $table->string('travally_advs_location',250);
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
        // drop table
        Schema::drop('travally_advs');
    }
}
