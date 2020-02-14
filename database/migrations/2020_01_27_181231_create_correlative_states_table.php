<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrelativeStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlative_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('correlative_type_id');
            $table->unsignedBigInteger('fiscal_year_id');
            $table->unsignedBigInteger('correlative_id');
            $table->foreign('correlative_id')->references('id')->on('correlatives');
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
        Schema::dropIfExists('correlative_states');
    }
}
