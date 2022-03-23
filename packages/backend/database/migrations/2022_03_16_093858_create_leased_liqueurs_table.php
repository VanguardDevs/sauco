<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasedLiqueursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leased_liqueurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lessor');
            $table->unsignedBigInteger('lessee');
            $table->date('date_from');
            $table->date('date_until');
            $table->timestamps();
            $table->unsignedBigInteger('liqueur_id');
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
        Schema::dropIfExists('leased_liqueurs');
    }
}
