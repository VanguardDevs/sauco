<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivityTaxpayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_taxpayer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('economic_activity_id')->references('id')->on('economic_activities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
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
        Schema::dropIfExists('economic_activity_taxpayer');
    }
}
