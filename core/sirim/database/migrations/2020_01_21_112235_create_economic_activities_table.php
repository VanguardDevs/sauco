<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name', 500);
            $table->string('aliquote');
            $table->string('min_tax');
            $table->unsignedBigInteger('activity_classification_id');
            $table->foreign('activity_classification_id')->references('id')->on('activity_classifications')
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
        Schema::dropIfExists('economic_activities');
    }
}
