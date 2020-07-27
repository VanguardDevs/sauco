<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxpayerIdToReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->timestamp('processed_at')->nullable();
            $table->float('amount')->nullable();
            $table->unsignedBigInteger('taxpayer_id')->nullable();
            $table->unsignedBigInteger('concept_id')->nullable();
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('concept_id')->references('id')->on('concepts')
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
        Schema::table('receivables', function (Blueprint $table) {
            //
        });
    }
}
