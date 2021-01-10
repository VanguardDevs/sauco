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
            $table->unsignedBigInteger('correlative_number_id');
            $table->unsignedBigInteger('correlative_type_id');
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('years')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('correlative_number_id')->references('id')->on('correlative_numbers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('correlative_type_id')->references('id')->on('correlative_types')
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
        Schema::dropIfExists('correlatives');
    }
}
