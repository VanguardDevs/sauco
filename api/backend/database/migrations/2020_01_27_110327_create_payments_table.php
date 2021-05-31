<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->unique();
            $table->decimal('amount', 15, 2);
            $table->string('observations')->nullable();
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('processed_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
