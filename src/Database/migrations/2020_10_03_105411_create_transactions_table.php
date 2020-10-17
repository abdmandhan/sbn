<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('txn_reff')->unique();
            $table->integer('user_id');
            $table->string('ifua')->nullable();
            $table->string('product_code');
            $table->integer('user_account_redeem_id')->nullable();
            $table->string('txn_type_code');
            $table->string('txn_status_code');
            $table->timestamp('traded_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('settled_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('exported_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->float('gross_txn', 10, 0)->default(0);
            $table->float('amount_fee', 10, 0)->default(0);
            $table->float('nett_txn', 10, 0)->default(0);
            $table->float('must_pay', 10, 0)->nullable();
            $table->float('unit_txn', 10, 0)->nullable();
            $table->float('holding_before', 10, 0)->nullable();
            $table->float('holding_after', 10, 0)->nullable();
            $table->float('initial_amount', 10, 0)->nullable();
            $table->float('avg_price', 10, 0)->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('is_show')->nullable()->default(0);
            $table->boolean('is_use_voucher')->nullable()->default(0);
            $table->integer('is_get_point')->nullable();
            $table->boolean('is_all')->nullable()->default(0);
            $table->boolean('is_voucher_redem')->nullable();
            $table->integer('parent_txn_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('approved_by')->nullable();
            $table->integer('edited_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
