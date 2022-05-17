<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('num');
            $table->timestamps();
            $table->foreign('period_id')->references('id')->on('intervals')
            ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('taxpayer_requirement', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('requirement_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('concept_requirement', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('requirement_id');
            $table->unsignedBigInteger('concept_id');
            $table->foreign('concept_id')->references('id')->on('concepts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')
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
        Schema::dropIfExists('taxpayer_requirement');
        Schema::dropIfExists('concept_requirement');
        Schema::dropIfExists('requirements');

    }
}
