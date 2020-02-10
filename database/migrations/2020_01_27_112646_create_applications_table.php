<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num');
            $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('settlement_id');
            $table->unsignedBigInteger('application_state_id');
            $table->foreign('application_state_id')->references('id')->on('application_states');
            $table->foreign('settlement_id')->references('id')->on('settlements');
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
        Schema::dropIfExists('applications');
    }
}
