<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxpayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxpayers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rif');
            $table->string('name');
            $table->string('fiscal_address');
            $table->float('capital')->nullable();
            $table->string('compliance_use')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('taxpayer_type_id');
            $table->unsignedBigInteger('economic_sector_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('community_id');
            $table->foreign('community_id')->references('id')->on('communities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_type_id')->references('id')->on('taxpayer_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('economic_sector_id')->references('id')->on('economic_sectors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxpayers');
    }
}