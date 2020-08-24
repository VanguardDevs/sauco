<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNullAffidavitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('null_affidavits', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('affidavit_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('affidavit_id')->references('id')->on('affidavits')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('null_affidavits');
    }
}
