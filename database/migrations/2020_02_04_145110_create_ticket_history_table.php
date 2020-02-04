<?php

use App\Models\Ticket\History;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTicketHistoryTable
 */
class CreateTicketHistoryTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_history',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamp('date');
                $table->bigInteger('ticket_id');
                $table->bigInteger('user_id');
                $table->longText('old')
                    ->nullable();
                $table->longText('new')
                    ->nullable();
            });

        $tickets = Ticket::query()
            ->get();

        /** @var Ticket $ticket */
        foreach ($tickets as $ticket) {
            $user_id = $ticket->updated_user_id ?? $ticket->created_user_id;
            if (empty($user_id)) {
                continue;
            }
            History::create([
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->updated_user_id ?? $ticket->created_user_id,
                'date' => $ticket->updated_at ?? $ticket->created_at,
                'new' => json_encode($ticket->getAttributes()),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_history');
    }
}
