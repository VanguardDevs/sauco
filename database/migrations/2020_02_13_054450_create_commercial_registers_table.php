<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->unique();
            // $table->string('volume');
            // $table->string('case_file');
            $table->date('start_date');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
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
        Schema::dropIfExists('commercial_registers');
    }
}
