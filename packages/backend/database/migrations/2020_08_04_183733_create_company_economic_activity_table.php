<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyEconomicActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_economic_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();


            $table->foreign('company_id')->references('id')
                ->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('economic_activity_id')->references('id')
                ->on('economic_activities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_economic_activity');
    }
}
