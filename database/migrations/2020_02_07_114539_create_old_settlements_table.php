<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num');
            $table->unsignedBigInteger('old_license_id');
            $table->foreign('old_license_id')->references('id')->on('old_licenses');
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
        Schema::dropIfExists('old_settlements');
    }
}
