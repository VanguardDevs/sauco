<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisals', function (Blueprint $table) {
            $table->id();
            $table->boolean('liquidation_status')->default(0);
            $table->decimal('amount', 20);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('petro_price_id');

            $table->foreign('petro_price_id')->references('id')->on('petro_prices')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')
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
        Schema::dropIfExists('appraisals');
    }
}
