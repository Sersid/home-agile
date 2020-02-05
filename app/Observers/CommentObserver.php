<?php

namespace App\Observers;

use App\Jobs\NotifyWatchersComment;
use App\Models\Ticket\Comment;

/**
 * Class CommentObserver
 * @package App\Observers
 */
class CommentObserver extends BaseObserver
{
    /**
     * Handle the ticket "created" event.
     *
     * @param Comment $comment
     *
     * @return void
     */
    public function creating(Comment $comment)
    {
        $this->setAuthor($comment);
    }

    /**
     * Handle the ticket "updated" event.
     *
     * @param Comment $comment
     *
     * @return void
     */
    public function updating(Comment $comment)
    {
        $this->setRedactor($comment);
    }

    /**
     * @param Comment $comment
     */
    public function created(Comment $comment)
    {
        NotifyWatchersComment::dispatch($comment)->delay(now()->addSeconds(30));
    }
}
