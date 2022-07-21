<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCubiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cubicles', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('taxpayer_id');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('item_id')->references('id')->on('items')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('disincorporated_at')->nullable();
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
        Schema::dropIfExists('cubicles');
    }
}
