<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiqueursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liqueurs', function (Blueprint $table) {
            $table->id();
            $table->string('num')->nullable();
            $table->string('work_hours')->nullable();
            $table->date('registry_date');
            $table->boolean('is_mobile')->nullable();
            $table->unsignedBigInteger('liqueur_parameter_id')->nullable();
            $table->unsignedBigInteger('liqueur_classification_id')->nullable();
            $table->unsignedBigInteger('license_id');
            $table->foreign('liqueur_classification_id')->references('id')->on('liqueur_classifications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liqueur_parameter_id')->references('id')->on('liqueur_parameters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')
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
        Schema::dropIfExists('liqueurs');
    }
}
