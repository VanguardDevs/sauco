<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_payment', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('settlement_id');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('settlement_id')->references('id')->on('settlements')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlement_payment');
    }
}
