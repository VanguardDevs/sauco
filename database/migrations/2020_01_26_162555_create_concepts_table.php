<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('law');
            $table->string('description');
            $table->string('value');
            $table->date('publication_date');
            $table->unsignedBigInteger('ordinance_id');
            $table->unsignedBigInteger('charging_method_id');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods');
            $table->foreign('ordinance_id')->references('id')->on('ordinances');
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
        Schema::dropIfExists('concepts');
    }
}
