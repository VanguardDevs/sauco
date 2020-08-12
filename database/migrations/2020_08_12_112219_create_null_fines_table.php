<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNullFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('null_fines', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('fine_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('fine_id')->references('id')->on('fines')
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
        Schema::dropIfExists('null_fines');
    }
}
