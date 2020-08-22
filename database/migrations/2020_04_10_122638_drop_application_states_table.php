<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropApplicationStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('applications', function (Blueprint $table) {
           // $table->dropForeign(['application_state_id']);
            // $table->dropColumn(['application_state_id']);
        // });

        Schema::dropIfExists('application_states');
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
