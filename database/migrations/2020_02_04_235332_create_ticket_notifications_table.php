<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTicketNotificationsTable
 */
class CreateTicketNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ticket_id')->unique();
            $table->timestamp('on_changed')->nullable();
        });

        $tickets = \App\Models\Ticket\Ticket::query()
            ->select(['id', 'updated_at'])
            ->get();

        foreach ($tickets as $ticket) {
            \App\Models\Ticket\Notification::create([
                'ticket_id' => $ticket->id,
                'on_changed' => $ticket->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_notifications');
    }
}
