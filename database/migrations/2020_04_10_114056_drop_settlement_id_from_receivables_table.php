<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSettlementIdFromReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivables', function (Blueprint $table) {
            $table->dropForeign(['taxpayer_id']);
            $table->dropForeign(['concept_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
            $table->dropColumn(['taxpayer_id']);
            $table->dropColumn(['concept_id']);
            $table->dropColumn(['processed_at']);
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->dropForeign(['concept_id']);
            $table->dropForeign(['state_id']);
            $table->dropColumn(['state_id']);
            $table->dropColumn(['concept_id']);
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
