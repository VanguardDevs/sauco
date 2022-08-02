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
            $table->unsignedBigInteger('liqueur_id');
            $table->unsignedBigInteger('leaser_id');
            $table->date('since');
            $table->date('until');
            $table->foreign('liqueur_id')->references('id')->on('liqueurs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('leaser_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
