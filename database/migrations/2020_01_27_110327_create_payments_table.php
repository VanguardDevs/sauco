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
            $table->float('amount');
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_state_id');
            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onUpdate('cascade')->onDelete('cascade');
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
