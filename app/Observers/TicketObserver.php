<?php

namespace App\Observers;

use App\Jobs\NotifyWatchers;
use App\Models\Ticket\Ticket;
use App\Notifications\NowYouExecutor;
use App\Services\Ticket\HistoryService;
use App\Services\Ticket\WatcherService;

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
        // Оповещаем исполнителя
        $this->notifyExecutor($ticket);
        // Редактор подписывается на тикет
        $this->watch($ticket, $ticket->updated_user_id);
        // Исполнитель тоже
        if ($ticket->updated_user_id != $ticket->executor_id) {
            $this->watch($ticket, $ticket->executor_id);
        }
        // Добавление изменения в историю
        (new HistoryService())->add($ticket->id,
            $ticket->updated_at,
            $ticket->updated_user_id,
            $ticket->getOriginal(),
            $ticket->getChanges()
        );
        // Уведомить наблюдателей
        NotifyWatchers::dispatch($ticket)
            ->delay(now()->addSeconds(30));
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
            $ticket->executor->notify(new NowYouExecutor($ticket));
        }
    }

    /**
     * Пользователя в наблюдатели
     *
     * @param Ticket $ticket
     * @param int|null $user_id
     */
    private function watch(Ticket $ticket, $user_id)
    {
        if (!empty($user_id)) {
            (new WatcherService())->watch($ticket->id, $user_id);
        }
    }

    /**
     * After created
     *
     * @param Ticket $ticket
     */
    public function created(Ticket $ticket)
    {
        // Добавление в историю
        (new HistoryService())->add($ticket->id,
            $ticket->created_at,
            $ticket->created_user_id,
            [],
            $ticket->getAttributes()
        );
        // Автор подписывается на тикет
        $this->watch($ticket, $ticket->created_user_id);
    }
}
