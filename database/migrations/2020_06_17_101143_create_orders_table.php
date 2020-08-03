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
            $table->date('pickup_date');
            $table->string('src_appointment_time')->nullable();
            $table->string('des_appointment_time')->nullable();
            $table->double('min_temperature')->nullable();
            $table->double('max_temperature')->nullable();
            $table->double('cost');
            $table->double('estimated_value');
            $table->string('start_loadtime')->nullable();
            $table->string('end_loadtime')->nullable();
            $table->unsignedBigInteger('shipper_id');
         
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
