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
            $table->integer('num');
            $table->date('emission_date');
            $table->date('expiration_date');
            $table->unsignedBigInteger('correlative_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('license_state_id');
            $table->foreign('license_state_id')->references('id')->on('license_states');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->foreign('correlative_id')->references('id')->on('correlatives');
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
        Schema::dropIfExists('economic_activity_licenses');
    }
}
