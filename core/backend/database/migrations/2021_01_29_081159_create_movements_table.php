<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 20);
            $table->boolean('credit', false);
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('liquidation_id');
            $table->timestamps();

            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
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
        Schema::dropIfExists('movements');
    }
}
