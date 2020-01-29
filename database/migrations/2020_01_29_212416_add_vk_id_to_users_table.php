<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddVkIdToUsersTable
 */
class AddVkIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('users',
            function (Blueprint $table) {
                $table->bigInteger('vk')
                    ->nullable();
            });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('users',
            function (Blueprint $table) {
                $table->dropColumn('vk');
            });
    }
}
