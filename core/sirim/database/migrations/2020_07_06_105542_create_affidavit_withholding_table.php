<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffidavitWithholdingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affidavit_withholding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('withholding_id');
            $table->unsignedBigInteger('affidavit_id');
            $table->foreign('affidavit_id')->references('id')->on('affidavits')
                ->onUpdate('cascade')->onUpdate('cascade');
            $table->foreign('withholding_id')->references('id')->on('withholdings')
                ->onUpdate('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('affidavit_withholding');
    }
}
