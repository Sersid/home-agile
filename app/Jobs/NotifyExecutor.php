<?php

namespace App\Jobs;

use App\Models\Ticket\Ticket;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use VK\Client\VKApiClient;
use VK\Exceptions\Api;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

/**
 * Class NotifyExecutor
 * @package App\Jobs
 */
class NotifyExecutor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Ticket */
    protected $ticket;

    private $token;

    /**
     * Create a new job instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->token = env('VK_API_ACCESS_TOKEN');
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @param UserRepository $userRepository
     *
     * @return void
     * @throws Api\VKApiMessagesCantFwdException
     * @throws Api\VKApiMessagesChatBotFeatureException
     * @throws Api\VKApiMessagesChatUserNoAccessException
     * @throws Api\VKApiMessagesContactNotFoundException
     * @throws Api\VKApiMessagesDenySendException
     * @throws Api\VKApiMessagesKeyboardInvalidException
     * @throws Api\VKApiMessagesPrivacyException
     * @throws Api\VKApiMessagesTooLongForwardsException
     * @throws Api\VKApiMessagesTooLongMessageException
     * @throws Api\VKApiMessagesTooManyPostsException
     * @throws Api\VKApiMessagesUserBlockedException
     * @throws VKApiException
     * @throws VKClientException
     */
    public function handle(UserRepository $userRepository)
    {
        if (empty($this->token)) {
            return;
        }
        $users = $userRepository->getForVkNotify($this->ticket->updated_user_id, $this->ticket->executor_id);
        /** @var User $to */
        $to = $users['to'];
        if (empty($to->vk)) {
            return;
        }
        /** @var User $from */
        $from = $users['from'];
        $message = sprintf(
            "%s %s на тебя задачу #%s \"%s\"",
            $from->name,
            $from->isMale() ? 'назначил' : 'назначила',
            $this->ticket->id,
            $this->ticket->title
        );
        $vk = new VKApiClient('5.103');
        $vk->messages()
            ->send($this->token,
                [
                    'peer_id' => $to->vk,
                    'random_id' => $this->ticket->id,
                    'message' => $message,
                ]);
    }
}
