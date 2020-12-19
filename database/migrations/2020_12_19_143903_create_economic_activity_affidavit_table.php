<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivityAffidavitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activity_affidavit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affidavit_id');
            $table->unsignedBigInteger('economic_activity_id');
            $table->decimal('calc_amount', 15);
            $table->decimal('brute_amount', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('economic_activity_affidavit');
    }
}
