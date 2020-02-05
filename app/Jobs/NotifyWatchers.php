<?php

namespace App\Jobs;

use App\Models\Ticket\Ticket;
use App\Repositories\Ticket\HistoryRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Services\Ticket\NotificationService;
use VK\Exceptions;

/**
 * Уведомляет в ВК наблюдателей об изменении тикета
 * @package App\Jobs
 */
class NotifyWatchers extends BaseNotify
{
    /** @var Ticket */
    protected $ticket;
    /** @var TicketRepository */
    protected $ticketRepository;
    /** @var HistoryRepository */
    protected $historyRepository;

    /**
     * Create a new job instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->ticketRepository = new TicketRepository();
        $this->historyRepository = new HistoryRepository();
        parent::__construct();
    }

    /**
     * Execute the job.
     * @return void
     * @throws Exceptions\Api\VKApiMessagesCantFwdException
     * @throws Exceptions\Api\VKApiMessagesChatBotFeatureException
     * @throws Exceptions\Api\VKApiMessagesChatUserNoAccessException
     * @throws Exceptions\Api\VKApiMessagesContactNotFoundException
     * @throws Exceptions\Api\VKApiMessagesDenySendException
     * @throws Exceptions\Api\VKApiMessagesKeyboardInvalidException
     * @throws Exceptions\Api\VKApiMessagesPrivacyException
     * @throws Exceptions\Api\VKApiMessagesTooLongForwardsException
     * @throws Exceptions\Api\VKApiMessagesTooLongMessageException
     * @throws Exceptions\Api\VKApiMessagesTooManyPostsException
     * @throws Exceptions\Api\VKApiMessagesUserBlockedException
     * @throws Exceptions\VKApiException
     * @throws Exceptions\VKClientException
     */
    public function handle()
    {
        if (empty($this->token)) {
            return;
        }
        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->getForNotify($this->ticket->id);
        if (empty($ticket)) {
            return;
        }
        // Если тикет был изменен, не нужно ничего отправлять
        if ($ticket->updated_at != $this->ticket->updated_at) {
            return;
        }
        $lastNotified = empty($ticket->notification) ? null : $ticket->notification->on_changed;
        // Обновление даты последнего оповещения
        (new NotificationService)->saveOnChanged($ticket->id, now());
        // Получаем все изменения с даты последнего оповещения
        $changes = $this->historyRepository->getChanges($this->ticket->id, $lastNotified);
        if (empty($changes)) {
            return;
        }
        foreach ($ticket->watcherUsers as $user) {
            // У наблюдателя должен быть указан VK
            if (empty($user->vk)) {
                continue;
            }
            foreach ($changes as $change) {
                // Не нужно отправлять автору изменений
                if ($change['user_id'] == $user->id) {
                    continue;
                }
                if (empty($change['old'])) {
                    $view = view('notifications.vk.new', compact('ticket'));
                } else {
                    $oldTicket = new Ticket($change['old']);
                    $view = view('notifications.vk.changed', compact('ticket', 'oldTicket', 'change'));
                }
                $this->toVk($user->vk, $view->toHtml());
            }
        }
    }
}
