<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate')->unique();
            $table->string('body_serial');
            $table->string('engine_serial');
            $table->boolean('status');
            $table->float('weight');
            $table->unsignedBigInteger('capacity');
            $table->unsignedBigInteger('stalls');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('vehicle_model_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('vehicle_classification_id');
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vehicle_classification_id')->references('id')->on('vehicle_classifications')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('vehicles');
    }
}
