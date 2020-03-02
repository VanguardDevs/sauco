<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivitySettlementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_settlement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 15, 2);
            $table->decimal('brute_amount', 15,2);
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('settlement_id');
            $table->foreign('economic_activity_id')->references('id')
                ->on('economic_activities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('settlement_id')->references('id')
                ->on('settlements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('economic_activity_settlement');
    }
}
