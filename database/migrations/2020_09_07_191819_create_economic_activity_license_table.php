<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivityLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_license', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('license_id');
            $table->timestamps();

            $table->foreign('economic_activity_id')->references('id')->on('economic_activities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('licenses', function (Blueprint $table) {
            $table->date('expiration_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('representation_id')->nullable();

            $table->foreign('representation_id')->references('id')->on('representations')
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
        Schema::dropIfExists('economic_activity_license');
    }
}
