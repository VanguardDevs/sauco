<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNullWithholdingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('null_withholdings', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('withholding_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('withholding_id')->references('id')->on('withholdings')
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
        Schema::dropIfExists('null_withholdings');
    }
}
