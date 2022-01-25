<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquerparametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquerparameters', function (Blueprint $table) {
            $table->id();
            $table->float('new_registry_amount');
            $table->float('renew_registry_amount');
            $table->boolean('movil');
            $table->unsignedBigInteger('liquer_classifications_id');
            $table->foreign('liquer_classifications_id')->references('id')->on('liquer_classifications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('liquer_zone_id');    
            $table->foreign('liquer_zone_id')->references('id')->on('liquer_zone')
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
        Schema::dropIfExists('liquerparameters');
    }
}
