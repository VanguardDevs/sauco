<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('local');
            $table->string('street');
            $table->string('floor');
            $table->string('cadastre_num');
            $table->string('bulletin');
            $table->string('land_valuation');
            $table->string('contract')->nullable();
            $table->string('document')->nullable();
            $table->unsignedBigInteger('ownership_status_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('property_type_id');
            $table->foreign('ownership_status_id')->references('id')->on('ownership_statuses');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->foreign('property_type_id')->references('id')->on('property_types');
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
        Schema::dropIfExists('properties');
    }
}
