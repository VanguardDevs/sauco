<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiqueurLiquidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liqueur_liquidation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidation_id');
            $table->unsignedBigInteger('liqueur_id');
            $table->timestamps();
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liqueur_id')->references('id')->on('liqueurs')
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
        Schema::dropIfExists('liqueur_liquidation');
    }
}
