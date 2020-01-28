

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
            $table->string('observations', 500)->nullable();
            // $table->date('answer_date')->nullable();
            $table->unsignedBigInteger('fine_type_id');
            $table->unsignedBigInteger('fine_state_id');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('fine_state_id')->references('id')->on('fine_states');
            $table->foreign('fine_type_id')->references('id')->on('fine_types');
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

