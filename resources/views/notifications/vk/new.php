<?php
/** @var Ticket $ticket */

use App\Models\Ticket\Ticket;

echo "📋 " . $ticket->author->name . " ";
echo $ticket->author->genderVerb('создал', 'создала');
echo " новый тикет #";
echo $ticket->id;
echo ' "' . $ticket->title . '":';
echo "\n";
if (!empty($ticket->description)) {
    echo "Описание: " . $ticket->description . "\n";
}
if (!empty($ticket->executor)) {
    echo "Исполнитель: " . $ticket->executor->name . "\n";
}
if (!empty($ticket->term)) {
    echo "Срок: " . date('d.m.Y', strtotime($ticket->term)) . "\n";
}
if (!empty($ticket->priority)) {
    echo "Приоритет: " . $ticket->getPriority()['name'] . "\n";
}
if (!empty($ticket->status)) {
    echo "Статус: " . $ticket->getStatus()['name'] . "\n";
}
echo "\n";
echo $ticket->getUrl();
