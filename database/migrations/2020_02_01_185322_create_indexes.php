<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->index('agile_id', 'index_agile_id');
        });
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->index('ticket_id', 'index_ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex('index_agile_id');
        });
        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->dropIndex('index_ticket_id');
        });
    }
}
