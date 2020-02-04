<?php
/** @var Ticket $ticket */

use App\Models\Ticket\Ticket;

echo $ticket->redactor->name . " " . $ticket->redactor->genderVerb('назначил', 'назначила');
echo ' на тебя тикет #' . $ticket->id . ' "' . $ticket->title . '":';
echo "\n";
echo "\n";
echo $ticket->getUrl();
