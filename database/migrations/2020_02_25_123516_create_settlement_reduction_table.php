<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementReductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_reduction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('settlement_id');
            $table->unsignedBigInteger('reduction_id');
            $table->foreign('settlement_id')->references('id')->on('settlements')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reduction_id')->references('id')->on('reductions')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('settlement_reduction');
    }
}
