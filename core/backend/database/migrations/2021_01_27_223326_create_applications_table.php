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
            $table->id();
            $table->string('num');
            $table->float('amount');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('concept_id');
            $table->timestamp('approved_at');
            $table->timestamps();

            $table->foreign('concept_id')->references('id')->on('concepts')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
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
        Schema::dropIfExists('applications');
    }
}
