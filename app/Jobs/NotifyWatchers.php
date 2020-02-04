<?php

namespace App\Jobs;

use App\Models\Ticket\Ticket;
use App\Repositories\Ticket\HistoryRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Services\Ticket\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use VK\Client\VKApiClient;
use VK\Exceptions;

/**
 * Уведомляет наблюдателей об изменении тикета
 * @package App\Jobs
 */
class NotifyWatchers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Ticket */
    protected $ticket;
    /** @var TicketRepository */
    protected $ticketRepository;
    /** @var string|null */
    protected $token;
    /** @var HistoryRepository */
    protected $historyRepository;

    /**
     * Create a new job instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->token = env('VK_API_ACCESS_TOKEN');
        $this->ticket = $ticket;
        $this->ticketRepository = new TicketRepository();
        $this->historyRepository = new HistoryRepository();
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
        $nowNotified = now();
        $lastNotified = empty($ticket->notification) ? null : $ticket->notification->on_changed;
        $changes = $this->historyRepository->getChanges($this->ticket->id, $lastNotified);
        if (!empty($changes)) {
            foreach ($ticket->watchers as $watcher) {
                // У наблюдателя должен быть указан VK
                if (empty($watcher->user->vk)) {
                    continue;
                }
                foreach ($changes as $change) {
                    //Не нужно отправлять автору изменений
                    if ($change['user_id'] == $watcher->user_id) {
                        continue;
                    }
                    if (empty($change['old'])) {
                        $view = view('notifications.vk.new', compact('ticket'));
                    } else {
                        $oldTicket = new Ticket($change['old']);
                        $view = view('notifications.vk.changed', compact('ticket', 'oldTicket', 'change'));
                    }
                    $this->send($watcher->user->vk, $view->toHtml());
                }
            }
        }
        (new NotificationService)->saveOnChanged($ticket->id, $nowNotified);
    }

    /**
     * @param $to
     * @param $message
     *
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
    private function send($to, $message)
    {
        $vk = new VKApiClient('5.103');
        $vk->messages()
            ->send($this->token, [
                'peer_id' => $to,
                'message' => $message,
                'random_id' => rand(1000000000, 9999999999),
            ]);
    }
}
