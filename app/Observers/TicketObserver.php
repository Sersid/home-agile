<?php

namespace App\Observers;

use App\Jobs\NotifyExecutor;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Watcher;

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
        // Редактор подписывается на тикет
        $this->watch($ticket, $ticket->updated_user_id);
        // Исполнитель тоже
        if ($ticket->updated_user_id != $ticket->executor_id) {
            $this->watch($ticket, $ticket->executor_id);
        }
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

    /**
     * After created
     *
     * @param Ticket $ticket
     */
    public function created(Ticket $ticket)
    {
        $this->watch($ticket, $ticket->created_user_id);
    }

    /**
     * Добавляет автора в наблюдатели
     *
     * @param Ticket   $ticket
     * @param int|null $user_id
     */
    private function watch(Ticket $ticket, $user_id)
    {
        if (!empty($user_id)) {
            (new Watcher)->watch($ticket->id, $user_id);
        }
    }
}
