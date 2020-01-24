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
            $table->string('description', 500)->nullable();
            $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('application_state_id');
            $table->unsignedBigInteger('application_type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('application_state_id')->references('id')->on('application_states');
            $table->foreign('application_type_id')->references('id')->on('application_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
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
        Schema::dropIfExists('applications');
    }
}