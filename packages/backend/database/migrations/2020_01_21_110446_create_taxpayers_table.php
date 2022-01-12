<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxpayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxpayers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rif')->unique();
            $table->string('name');
            $table->boolean('active')->default(1);
            $table->string('address');
            $table->string('picture')->default('/public/default/emotions.svg');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('taxpayer_type_id');
            $table->unsignedBigInteger('parish_id');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('taxpayer_classification_id');
            $table->foreign('community_id')->references('id')->on('communities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parish_id')->references('id')->on('parishes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_type_id')->references('id')->on('taxpayer_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('taxpayer_classification_id')->references('id')->on('taxpayer_classifications')
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
        Schema::dropIfExists('taxpayers');
    }
}
