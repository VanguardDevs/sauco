<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivitySettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_settlements', function (Blueprint $table) {
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('settlement_id');
            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('settlement_id')->references('id')->on('settlements');
            $table->foreign('economic_activity_id')->references('id')->on('economic_activities');
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
        Schema::dropIfExists('economic_activity_settlements');
    }
}
