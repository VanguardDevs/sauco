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
            $table->string('num');
            $table->float('amount', 20, 2);
            $table->float('total_amount', 20, 2);
            $table->date('pay_date')->nullable();
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('payment_state_id');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_state_id')->references('id')->on('payment_states')
                ->onUpdate('cascade')->onDelete('cascade');
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
