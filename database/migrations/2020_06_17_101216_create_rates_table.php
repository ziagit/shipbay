<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->double('min_rate');            
            $table->double('_0k_1k');            
            $table->double('_1k_2k');            
            $table->double('_2k_3k');            
            $table->double('_3k_4k');            
            $table->double('_4k_5k');            
            $table->double('_5k_10k');            
            $table->double('above_10k');   
            $table->double('fsc');
            $table->double('transit_day');

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
        Schema::dropIfExists('rates');
    }
}
