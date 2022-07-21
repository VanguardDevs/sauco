<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->float('amount');
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('liquidation_id')->nullable();
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('generated_at');
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
        Schema::dropIfExists('credits');
    }
}
