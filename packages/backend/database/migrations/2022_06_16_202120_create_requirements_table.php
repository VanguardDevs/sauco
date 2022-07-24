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
            $table->unsignedBigInteger('concept_id');
            $table->timestamps();
            $table->foreign('concept_id')->references('id')->on('concepts')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('requirement_taxpayer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requirement_id');
            $table->unsignedBigInteger('taxpayer_id');            
            $table->unsignedBigInteger('liquidation_id');
            $table->boolean('active');
            $table->timestamps();
            $table->foreign('requirement_id')->references('id')->on('requirements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirement_taxpayer');
        Schema::dropIfExists('requirements');
    }
}
