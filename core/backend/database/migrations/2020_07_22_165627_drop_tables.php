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
        if (App::environment('staging')) {
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

            // Migrate companies
            Schema::table('commercial_denominations', function (Blueprint $table) {
                $table->integer('total_workers')->nullable();
                $table->string('address')->nullable();
                $table->boolean('active')->default(1);
                $table->boolean('principal')->default(1);
                $table->decimal('capital', 20, 2)->nullable();
                $table->date('constitution_date')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->unsignedBigInteger('community_id')->nullable();
                $table->unsignedBigInteger('parish_id')->nullable();
            });

            Schema::rename('commercial_denominations', 'companies');

            if (!Schema::hasTable('liquidations')) {
                Schema::rename('settlements', 'liquidations');
            }

            if (!Schema::hasTable('liquidation_types')) {
                Schema::rename('lists', 'liquidation_types');
            }

            Schema::table('liquidations', function (Blueprint $table) {
                $table->string('liquidable_type')->nullable();
                $table->unsignedBigInteger('payment_id')->nullable()->change();
                $table->unsignedBigInteger('liquidable_id')->nullable();
                $table->unsignedBigInteger('concept_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('taxpayer_id')->nullable();
                $table->unsignedBigInteger('status_id')->nullable();
                $table->foreign('status_id')->references('id')->on('status')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('concept_id')->references('id')->on('concepts')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('taxpayer_id')->references('id')->on('taxpayers')
                    ->onUpdate('cascade')->onDelete('cascade');
            });
            Schema::create('liquidation_payment', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('liquidation_id');
                $table->unsignedBigInteger('payment_id');
                $table->foreign('liquidation_id')->references('id')->on('liquidations')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('payment_id')->references('id')->on('payments')
                    ->onUpdate('cascade')->onDelete('cascade');
            });

            Schema::table('concepts', function (Blueprint $table) {
                $table->renameColumn('amount', 'min_amount');  
                $table->float('max_amount')->nullable();
                $table->renameColumn('list_id', 'liquidation_type_id');
            });

            Schema::table('payments', function (Blueprint $table) {
                $table->renameColumn('state_id', 'status_id');
            });

            // Drop unnused tables if exists
            if (Schema::hasTable('organization_payment')) {
                Schema::drop('organization_payment');
                Schema::drop('organizations');
            }
        }
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
