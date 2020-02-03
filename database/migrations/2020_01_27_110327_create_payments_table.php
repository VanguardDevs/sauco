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
            $table->string('description', 140);
            $table->float('amount', 20, 2);
            $table->float('total_amount', 20, 2);
            $table->unsignedBigInteger('payment_state_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('concept_id');
            $table->foreign('concept_id')->references('id')->on('concepts');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_state_id')->references('id')->on('payment_states');
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
        Schema::dropIfExists('payments');
    }
}
