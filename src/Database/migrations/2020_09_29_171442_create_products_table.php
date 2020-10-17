<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->integer('product_type_id');
            $table->string('name');
            $table->text('desc');
            $table->string('code');

            $table->bigInteger('total_asset');
            $table->integer('frequence');
            $table->integer('min_buy');
            $table->integer('max_buy');
            $table->integer('max_redemption_percent')->default(100);
            $table->integer('yield_accept_id'); //imbal hasil tipe (bulanan,tahunan)
            $table->integer('yield_type_id'); //imbal hasil tipe (float,fixed)
            $table->float('yield', 3, 2); //imbal hasil (percent)
            $table->float('yield_high', 3, 2); //imbal hasil
            $table->float('yield_low', 3, 2); //imbal hasil

            $table->date('launch_date');
            $table->date('settlement_date');
            $table->date('booking_start_date');
            $table->date('booking_end_date');
            $table->date('redemption_start_date');
            $table->date('redemption_end_date');

            $table->string('buy_period');
            $table->integer('maturity_years');

            $table->boolean('is_trade');
            $table->boolean('is_syaria');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
