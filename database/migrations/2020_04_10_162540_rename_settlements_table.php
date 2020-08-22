<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affidavits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('brute_amount', 15, 2);
            $table->decimal('amount', 9, 2);
            $table->unsignedBigInteger('economic_activity_id');
            $table->unsignedBigInteger('taxpayer_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('economic_activity_id')->references('id')->on('economic_activities');
            $table->foreign('taxpayer_id')->references('id')->on('taxpayers');
        });

        Schema::rename('affidavits', 'economic_activity_affidavit');
        Schema::rename('settlements', 'affidavits');
        Schema::rename('receivables', 'settlements');

        Schema::table('affidavits', function (Blueprint $table) {
            $table->dropColumn(['num']);
            $table->unsignedBigInteger('affidavit_id');
            $table->foreign('affidavit_id')->references('id')->on('economic_activity_affidavit')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('processed_at')->nullable();
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->string('num', 8)->nullable();
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
