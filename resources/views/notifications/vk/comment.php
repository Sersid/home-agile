<?php
/** @var Comment $comment */

use App\Models\Ticket\Comment;

echo "💬 " . $comment->author->name . " ";
echo $comment->author->genderVerb('добавил', 'добавила');
echo " комментарий к тикету #";
echo $comment->ticket->id;
echo ' "' . $comment->ticket->title . '":';
echo "\n\n";
echo $comment->text;
echo "\n\n";
echo $comment->ticket->getUrl();
