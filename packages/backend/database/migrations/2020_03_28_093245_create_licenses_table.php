<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->unique();
            $table->date('emission_date');
            $table->date('expiration_date')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('correlative_id');
            $table->unsignedBigInteger('liquidation_id')->nullable();
            $table->unsignedBigInteger('taxpayer_id');
            $table->unsignedBigInteger('ordinance_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('representation_id');
            $table->foreign('ordinance_id')->references('id')->on('ordinances')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('correlative_id')->references('id')->on('correlatives')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('representation_id')->references('id')->on('representations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_id')->references('id')->on('liquidations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('downloaded_at')->nullable();
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
        Schema::dropIfExists('licenses');
    }
}
