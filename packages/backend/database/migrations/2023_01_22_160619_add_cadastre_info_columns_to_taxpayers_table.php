<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCadastreInfoColumnsToTaxpayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxpayers', function (Blueprint $table) {
            $table->string('cadastre_num')->nullable();
            $table->string('property_area')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxpayers', function (Blueprint $table) {
            $table->dropColumn('cadastre_num');
            $table->dropColumn('property_area');
        });
    }
}
