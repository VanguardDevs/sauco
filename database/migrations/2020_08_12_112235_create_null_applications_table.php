<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNullApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('null_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('application_id')->references('id')->on('applications')
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
        Schema::dropIfExists('null_applications');
    }
}
