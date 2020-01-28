<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivityLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('emission_date');
            $table->date('expiration_date');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('settlement_id');
            $table->foreign('license_id')->references('id')->on('licenses');
            $table->foreign('settlement_id')->references('id')->on('settlements');
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
        Schema::dropIfExists('economic_activity_licenses');
    }
}
