<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxpayerPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxpayer_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('ownership_state_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ownership_state_id')->references('id')->on('ownership_states')
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
        Schema::dropIfExists('taxpayer_property');
    }
}
