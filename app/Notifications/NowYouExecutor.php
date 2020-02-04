<?php

namespace App\Notifications;

/**
 * Оповещает пользователя о том, что он теперь испольнитель
 * @package App\Notifications
 */
class NowYouExecutor extends VkNotification
{
    /**
     * @inheritDoc
     */
    function message()
    {
        return view('notifications.vk.executor', ['ticket' => $this->ticket])->toHtml();
    }
}
