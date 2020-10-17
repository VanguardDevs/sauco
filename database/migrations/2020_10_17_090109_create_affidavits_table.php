<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffidavitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affidavits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('month_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('processed_at');
            $table->timestamps();
        });

        Schema::create('economic_activity_affidavit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affidavit_id');
            $table->unsignedBigInteger('economic_activity_id');
            $table->decimal('total_amount', 15);
            $table->decimal('brute_amount', 20);
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
        Schema::dropIfExists('affidavits');
    }
}
