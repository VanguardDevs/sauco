<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlatives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num');
            $table->unsignedBigInteger('correlative_type_id');
            $table->unsignedBigInteger('fiscal_year_id');
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years');
            $table->foreign('correlative_type_id')->references('id')->on('correlative_types');
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
        Schema::dropIfExists('correlatives');
    }
}
