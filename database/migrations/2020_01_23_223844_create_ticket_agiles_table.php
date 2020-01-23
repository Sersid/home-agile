<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTicketAgilesTable
 */
class CreateTicketAgilesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_agiles',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->softDeletes();
                $table->string('title');
                $table->bigInteger('created_user_id')
                    ->nullable();
                $table->bigInteger('updated_user_id')
                    ->nullable();
            });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_agiles');
    }
}
