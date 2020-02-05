<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use VK\Client\VKApiClient;
use VK\Exceptions;

/**
 * Class NotifyToVk
 * @package App\Jobs
 */
abstract class BaseNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var string|null */
    protected $token;

    public function __construct()
    {
        $this->token = env('VK_API_ACCESS_TOKEN');
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
    protected function toVk($to, $message)
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
