<?php

namespace App\Observers;

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
}
