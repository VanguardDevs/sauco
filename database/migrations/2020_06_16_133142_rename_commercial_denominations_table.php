<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCommercialDenominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commercial_denominations', function (Blueprint $table) {
            $table->integer('total_workers')->nullable();
            $table->decimal('capital', 20, 2)->nullable();
        });

        Schema::rename('commercial_denominations', 'companies');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('companies', 'commercial_denominations');
    }
}
