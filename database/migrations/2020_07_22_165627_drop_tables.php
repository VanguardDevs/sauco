<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('settlement_reduction');
        Schema::dropIfExists('reductions');

        Schema::table('taxpayers', function (Blueprint $table) {
            $table->unsignedBigInteger('parish_id')->nullable();
        });

        /**
         * Add company_id to affidavits
         */        
        Schema::table('affidavits', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        /**
        * Update amount column of fines, applications and settlements
         */       
        Schema::table('fines', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
            $table->renameColumn('state_id', 'status_id');
            $table->foreign('status_id')->references('id')->on('status')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        /**
        * Recover states and municipalities tables
         */        
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('municipalities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')
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
        //
    }
}
