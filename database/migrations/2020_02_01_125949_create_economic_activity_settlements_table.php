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
            $table->bigIncrements('id');
            $table->integer('num');
            $table->string('description', 140);
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('month_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('economic_activity_license_id');
            $table->foreign('economic_activity_license_id', 'license_id')->references('id')->on('economic_activity_licenses');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('month_id')->references('id')->on('months');
            $table->foreign('economic_activity_id')->references('id')->on('economic_activities');
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
        Schema::dropIfExists('economic_activity_settlements');
    }
}
