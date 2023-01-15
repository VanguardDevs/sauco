<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleCorrelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_correlatives', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('license_id')->nullable();
            $table->foreign('year_id')->references('id')->on('years')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('vehicle_correlatives');
    }
}
