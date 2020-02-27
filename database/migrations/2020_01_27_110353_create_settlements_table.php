<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('concept_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('month_id');
            $table->foreign('month_id')->references('id')->on('months')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('concept_id')->references('id')->on('concepts')
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
        Schema::dropIfExists('settlements');
    }
}
