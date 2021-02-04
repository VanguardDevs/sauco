<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffidavitFineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affidavit_fine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fine_id');
            $table->unsignedBigInteger('affidavit_id');
            $table->foreign('fine_id')->references('id')->on('fines')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('affidavit_id')->references('id')->on('affidavits')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('affidavit_fine');
    }
}
