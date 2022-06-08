<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiqueurParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liqueur_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('new_registry_amount');
            $table->float('renew_registry_amount');
            $table->float('authorization_registry_amount');
            $table->boolean('is_mobile');
            $table->unsignedBigInteger('liqueur_classification_id');
            $table->unsignedBigInteger('liqueur_zone_id');
            $table->unsignedBigInteger('charging_method_id');
            $table->foreign('liqueur_classification_id')->references('id')->on('liqueur_classifications')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liqueur_zone_id')->references('id')->on('liqueur_zones')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods')
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
        Schema::dropIfExists('liqueur_parameters');
    }
}
