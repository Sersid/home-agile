<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddAgileIdToTicketsTable
 */
class AddAgileIdToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('tickets',
            function (Blueprint $table) {
                $table->bigInteger('agile_id')
                    ->nullable();
            });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('tickets',
            function (Blueprint $table) {
                $table->dropColumn('agile_id');
            });
    }
}
