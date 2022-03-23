<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithholdingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withholdings', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->float('amount');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('retainer_id');
            // $table->unsignedBigInteger('withholder_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('retainer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('withholder_id')->references('id')->on('withholders')
                // ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('withholdings');
    }
}
