<?php

use App\Models\Ticket\Checklist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTicketChecklistsTable
 */
class CreateTicketChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_checklists',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->bigInteger('ticket_id');
                $table->string('title');
                $table->smallInteger('status')
                    ->default(Checklist::STATUS_UNCHECKED);
                $table->bigInteger('created_user_id')
                    ->nullable();
                $table->bigInteger('updated_user_id')
                    ->nullable();

                $table->index('ticket_id', 'index_ticket_id');
            });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_checklists');
    }
}
