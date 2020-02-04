<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use VK\Client\VKApiClient;
use VK\Exceptions\Api\VKApiMessagesCantFwdException;
use VK\Exceptions\Api\VKApiMessagesChatBotFeatureException;
use VK\Exceptions\Api\VKApiMessagesChatUserNoAccessException;
use VK\Exceptions\Api\VKApiMessagesContactNotFoundException;
use VK\Exceptions\Api\VKApiMessagesDenySendException;
use VK\Exceptions\Api\VKApiMessagesKeyboardInvalidException;
use VK\Exceptions\Api\VKApiMessagesPrivacyException;
use VK\Exceptions\Api\VKApiMessagesTooLongForwardsException;
use VK\Exceptions\Api\VKApiMessagesTooLongMessageException;
use VK\Exceptions\Api\VKApiMessagesTooManyPostsException;
use VK\Exceptions\Api\VKApiMessagesUserBlockedException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

/**
 * Оповещения в ВК
 * @package App\Channels
 */
class VkChannel
{
    protected $token;

    public function __construct()
    {
        $this->token = env('VK_API_ACCESS_TOKEN');
    }

    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @return void
     * @throws VKApiMessagesCantFwdException
     * @throws VKApiMessagesChatBotFeatureException
     * @throws VKApiMessagesChatUserNoAccessException
     * @throws VKApiMessagesContactNotFoundException
     * @throws VKApiMessagesDenySendException
     * @throws VKApiMessagesKeyboardInvalidException
     * @throws VKApiMessagesPrivacyException
     * @throws VKApiMessagesTooLongForwardsException
     * @throws VKApiMessagesTooLongMessageException
     * @throws VKApiMessagesTooManyPostsException
     * @throws VKApiMessagesUserBlockedException
     * @throws VKApiException
     * @throws VKClientException
     */
    public function send($notifiable, Notification $notification)
    {
        if (empty($this->token)) {
            return;
        }
        $vk = new VKApiClient('5.103');
        $params = array_merge($notification->toVk($notifiable), ['random_id' => rand(1000000000, 9999999999)]);
        $vk->messages()
            ->send($this->token, $params);
    }
}
