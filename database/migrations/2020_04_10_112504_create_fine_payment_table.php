<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_payment', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('fine_id');
            $table->foreign('fine_id')->references('id')->on('fines')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
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
        Schema::dropIfExists('fine_payment');
    }
}
