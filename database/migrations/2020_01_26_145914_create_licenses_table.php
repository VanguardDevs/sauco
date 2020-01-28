<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('license_type_id');
            $table->unsignedBigInteger('license_state_id');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('license_type_id')->references('id')->on('license_types');
            $table->foreign('license_state_id')->references('id')->on('license_states');
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
        Schema::dropIfExists('licenses');
    }
}
