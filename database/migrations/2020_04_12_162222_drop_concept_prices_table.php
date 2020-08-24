<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropConceptPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('concept_prices');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('workers');
        Schema::dropIfExists('personal_firms');
        Schema::dropIfExists('requisites');

        Schema::table('concepts', function (Blueprint $table) {
            $table->float('amount')->nullable();
            $table->unsignedBigInteger('charging_method_id')->nullable();
            $table->foreign('charging_method_id')->references('id')->on('charging_methods')
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
        //
    }
}
