<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observations', 500)->nullable();
            // $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('fine_type_id');
            $table->unsignedBigInteger('fine_state_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('fine_state_id')->references('id')->on('fine_states');
            $table->foreign('fine_type_id')->references('id')->on('fine_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
            $table->softDeletes();
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
        Schema::dropIfExists('fines');
    }
}
