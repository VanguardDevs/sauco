<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->index();
            $table->float('min_amount');
            $table->float('max_amount');
            $table->string('name');
            $table->boolean('own_income')->default(1);
            $table->boolean('has_requisite')->default(0);
            $table->unsignedBigInteger('interval_id');
            $table->unsignedBigInteger('charging_method_id');
            $table->unsignedBigInteger('accounting_account_id');
            $table->unsignedBigInteger('ordinance_id');
            $table->unsignedBigInteger('liquidation_type_id');
            $table->foreign('charging_method_id')->references('id')->on('charging_methods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('interval_id')->references('id')->on('intervals')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('accounting_account_id')->references('id')->on('accounting_accounts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('liquidation_type_id')->references('id')->on('liquidation_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ordinance_id')->references('id')->on('ordinances')
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
        Schema::dropIfExists('concepts');
    }
}
