<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num');
            $table->float('amount', 20, 2);
            $table->float('total_amount', 20, 2);
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('payment_state_id');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_state_id')->references('id')->on('payment_states');
            $table->foreign('license_id')->references('id')->on('licenses');
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
        Schema::dropIfExists('payments');
    }
}
