

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num');
            $table->string('observations', 500)->nullable();
            // $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('ordinance_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('ordinance_id')->references('id')->on('ordinances');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->softDeletes();
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
        Schema::dropIfExists('fines');
    }
}

