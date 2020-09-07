<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipmentaddresses', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('address');
            $table->string('country_id');
            $table->string('state_id');
            $table->string('city_id');
            $table->string('citycode_id');

            $table->string('refrence')->nullable();
            $table->text('instructions')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
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
        Schema::dropIfExists('shipmentaddresses');
    }
}
