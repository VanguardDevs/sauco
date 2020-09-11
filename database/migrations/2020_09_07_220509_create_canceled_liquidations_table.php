<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanceledLiquidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('liquidations')) {
            Schema::rename('settlements', 'liquidations');
        }

        Schema::table('liquidations', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        if (!Schema::hasTable('liquidation_types')) {
            Schema::rename('lists', 'liquidation_types');
        }

        Schema::create('canceled_liquidations', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->timestamps();
            $table->unsignedBigInteger('liquidation_id');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('payment_liquidation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidation_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('concepts', function (Blueprint $table) {
            $table->renameColumn('amount', 'min_amount');  
            $table->float('max_amount')->nullable();
            $table->renameColumn('list_id', 'liquidation_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canceled_liquidations');
    }
}
