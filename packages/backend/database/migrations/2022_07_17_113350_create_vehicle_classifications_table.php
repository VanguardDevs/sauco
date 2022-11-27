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
            $table->timestamps();
            $table->unsignedBigInteger('vehicle_parameter_id');
            $table->unsignedBigInteger('charging_method_id');
            $table->foreign('vehicle_parameter_id')->references('id')->on('vehicle_parameters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Artisan::call('db:seed', [
        '--class' => 'VehicleClassificationSeeder',
        '--force' => true
        ]);
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
