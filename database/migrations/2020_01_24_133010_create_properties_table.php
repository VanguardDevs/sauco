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
            $table->string('contract')->nullable();
            $table->string('document')->nullable();
            $table->unsignedBigInteger('ownership_statuses_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('property_type_id');
            $table->foreign('ownership_statuses_id')->references('id')->on('ownership_statuses');
            $table->foreign('community_id')->references('id')->on('communities');
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
