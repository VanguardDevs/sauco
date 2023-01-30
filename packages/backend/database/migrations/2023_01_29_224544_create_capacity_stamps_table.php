<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacityStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacity_stamps', function (Blueprint $table) {
            $table->id();
            $table->string('capacity');
            $table->string('observations');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('license_id')->references('id')->on('licenses')
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
        Schema::dropIfExists('capacity_stamps');
    }
}
