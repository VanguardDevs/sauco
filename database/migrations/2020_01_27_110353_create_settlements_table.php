<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num');
            $table->string('amount');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('concept_id');
            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->foreign('concept_id')->references('id')->on('concepts');
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
        Schema::dropIfExists('settlements');
    }
}
