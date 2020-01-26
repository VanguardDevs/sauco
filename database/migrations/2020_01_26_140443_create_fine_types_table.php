<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->string('law');
            $table->string('publication_date');
            $table->string('description');
            $table->unsignedBigInteger('charging_method_id');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods');
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
        Schema::dropIfExists('fine_types');
    }
}
