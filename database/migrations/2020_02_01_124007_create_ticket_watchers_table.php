<?php

use App\Models\Ticket\Ticket;
use App\Models\Ticket\Watcher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTicketWatchersTable
 */
class CreateTicketWatchersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_watchers',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->softDeletes();
                $table->bigInteger('ticket_id');
                $table->bigInteger('user_id');
                $table->unique(['ticket_id', 'user_id']);
            });

        $tickets = Ticket::query()
            ->select(['id', 'executor_id', 'created_user_id'])
            ->get();

        foreach ($tickets as $ticket) {
            if (!empty($ticket->created_user_id)) {
                Watcher::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $ticket->created_user_id,
                ]);
            }
            if (!empty($ticket->executor_id) && $ticket->created_user_id != $ticket->executor_id) {
                Watcher::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $ticket->executor_id,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_watchers');
    }
}
