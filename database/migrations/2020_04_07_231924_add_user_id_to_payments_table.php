<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('receivables', function (Blueprint $table) {
           $table->unsignedBigInteger('user_id')->nullable();
           $table->foreign('user_id')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('cascade'); 
       });

       Schema::table('payments', function (Blueprint $table) {
           $table->unsignedBigInteger('user_id')->nullable();
           $table->foreign('user_id')->references('id')->on('users')
               ->onUpdate('cascade')->ondelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
