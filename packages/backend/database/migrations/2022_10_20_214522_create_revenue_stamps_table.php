<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_stamps', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('payment_num');
            $table->decimal('amount', 15, 2);
            $table->string('observations');
            $table->unsignedBigInteger('license_id')->nullable();
            $table->timestamps();
            $table->foreign('license_id')->references('id')->on('licenses')
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
        Schema::dropIfExists('revenue_stamps');
    }
}
