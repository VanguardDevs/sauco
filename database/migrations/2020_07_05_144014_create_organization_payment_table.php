<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('organization_payment');
    }
}
