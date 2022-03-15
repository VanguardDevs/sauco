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
            $table->string('work_hours', 45);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('liqueur_parameter_id');
            $table->unsignedBigInteger('representation_id');
            $table->unsignedBigInteger('license_id');

            $table->foreign('company_id')->references('id')->on('companies')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liqueur_parameter_id')->references('id')->on('liqueur_parameters')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('representation_id')->references('id')->on('representations')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')
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
        Schema::dropIfExists('liqueurs');
    }
}
