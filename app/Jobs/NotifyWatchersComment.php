<?php

namespace App\Jobs;

use App\Models\Ticket\Comment;
use App\Repositories\Ticket\CommentRepository;
use VK\Exceptions;

/**
 * Уведомляет наблюдателей об изменении тикета
 * @package App\Jobs
 */
class NotifyWatchersComment extends BaseNotify
{
    /** @var Comment */
    protected $comment;
    protected $repository;

    /**
     * Create a new job instance.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->repository = new CommentRepository();
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
        /** @var Comment $comment */
        $comment = $this->repository->getForNotify($this->comment->id);
        if (empty($comment)) {
            return;
        }
        if (empty($comment->ticket)) {
            return;
        }
        foreach ($comment->ticket->watcherUsers as $user) {
            // У наблюдателя должен быть указан VK
            if (empty($user->vk)) {
                continue;
            }
            // Не нужно отправлять автору
            if ($comment->created_user_id == $user->id) {
                continue;
            }
            $message = view('notifications.vk.comment', compact('comment'))->toHtml();
            $this->toVk($user->vk, $message);
        }
    }
}
