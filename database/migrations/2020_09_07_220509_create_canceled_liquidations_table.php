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

        if (!Schema::hasTable('liquidation_types')) {
            Schema::rename('lists', 'liquidation_types');
        }

        Schema::table('liquidations', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id')->nullable()->change();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('concept_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('taxpayer_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('liquidation_type_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('concept_id')->references('id')->on('concepts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_type_id')->references('id')->on('liquidation_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('canceled_liquidations', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->timestamps();
            $table->unsignedBigInteger('liquidation_id');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('liquidation_payment', function (Blueprint $table) {
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

        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('state_id', 'status_id');
        });

        // Drop unnused tables if exists
        if (Schema::hasTable('organization_payment')) {
            Schema::drop('organization_payment');
            Schema::drop('organizations');
        }
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
