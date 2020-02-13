<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('representation_type_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('representation_type_id')->references('id')->on('representation_types');
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
        Schema::dropIfExists('representations');
    }
}
