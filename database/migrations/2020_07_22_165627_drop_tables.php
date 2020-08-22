<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn(['account_id']);
        });

        Schema::table('taxpayer_property', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });  

        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_types');
        Schema::dropIfExists('settlement_reduction');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('reductions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
