<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiqueurAnnexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liqueur_annexes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('annex_id');
            $table->unsignedBigInteger('liqueur_id');
            $table->timestamps();
            $table->foreign('annex_id')->references('id')->on('annexed_liqueurs')
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
        Schema::dropIfExists('liqueur_annexes');
    }
}
