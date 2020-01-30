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
            $table->unsignedBigInteger('ordinance_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('ordinance_id')->references('id')->on('ordinances');
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
        Schema::dropIfExists('applications');
    }
}
