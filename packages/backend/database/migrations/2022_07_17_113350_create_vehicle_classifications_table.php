<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('amount');
            $table->float('weight_from')->nullable();
            $table->float('weight_until')->nullable();
            $table->float('stalls_from')->nullable();
            $table->float('stalls_until')->nullable();
            $table->float('capacity_from')->nullable();
            $table->float('capacity_until')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('vehicle_parameter_id');
            $table->unsignedBigInteger('charging_method_id');
            $table->foreign('vehicle_parameter_id')->references('id')->on('vehicle_parameters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_classifications');
    }
}