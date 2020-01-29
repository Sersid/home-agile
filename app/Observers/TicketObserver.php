<?php

namespace App\Observers;

use App\Jobs\NotifyExecutor;
use App\Models\Ticket\Ticket;

/**
 * Class TicketObserver
 * @package App\Observers
 */
class TicketObserver extends BaseObserver
{
    /**
     * Handle the ticket "created" event.
     *
     * @param Ticket $ticket
     *
     * @return void
     */
    public function creating(Ticket $ticket)
    {
        $this->setAuthor($ticket);
    }

    /**
     * Handle the ticket "updated" event.
     *
     * @param Ticket $ticket
     *
     * @return void
     */
    public function updating(Ticket $ticket)
    {
        $this->setRedactor($ticket);
    }

    /**
     * Handle the comment "updated" event.
     *
     * @param Ticket $ticket
     *
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        $this->notifyExecutor($ticket);
    }

    /**
     * Оповещает исполнителя
     *
     * @param Ticket $ticket
     */
    private function notifyExecutor(Ticket $ticket)
    {
        if (!empty($ticket->executor_id)
            && $ticket->getOriginal('executor_id') != $ticket->executor_id
            && $ticket->executor_id != $ticket->updated_user_id) {
            NotifyExecutor::dispatch($ticket);
        }
    }
}
