<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('pickup_date')->nullable();
            $table->string('src_appointment_time')->nullable();
            $table->string('des_appointment_time')->nullable();
            $table->double('min_temperature')->nullable();
            $table->double('max_temperature')->nullable();
            $table->double('cost')->nullable();
            $table->double('estimated_value')->nullable();
            $table->string('instructions')->nullable();
            $table->string('charge_id');
            $table->string('uniqid')->unique();
            $table->unsignedBigInteger('shipper_id')->nullable();
         
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
        Schema::dropIfExists('orders');
    }
}
