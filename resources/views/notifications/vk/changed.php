<?php
/** @var Ticket $ticket */
/** @var Ticket $oldTicket */
/** @var array $change */

use App\Models\Ticket\Ticket;

echo "📝 " . $ticket->redactor->name . " ";
echo $ticket->redactor->genderVerb('изменил', 'изменила');
echo " тикет #";
echo $ticket->id;
echo ' "' . $oldTicket->title . '":';
echo "\n";
foreach ($change['new'] as $key => $value) {
    if ($oldTicket->getAttribute($key) == $ticket->getAttribute($key)) {
        continue;
    }
    switch ($key) {
        case 'title':
            echo "Заголовок: ";
            echo '"' . $oldTicket->title . '" => "' . $ticket->title . '"';
            break;
        case 'description':
            echo "Описание: " . (empty($ticket->description) ? '-' : $ticket->description);
            break;
        case 'term':
            echo "Срок: ";
            echo '"';
            echo empty($oldTicket->term) ? '-' : date('d.m.Y', strtotime($oldTicket->term));
            echo '" => "';
            echo empty($ticket->term) ? '-' : date('d.m.Y', strtotime($ticket->term));
            echo '"';
            break;
        case 'priority':
            echo "Приоритет: ";
            echo '"' . $oldTicket->getPriority()['name'] . '" => "' . $ticket->getPriority()['name'] . '"';
            break;
        case 'status':
            echo "Статус: ";
            echo '"' . $oldTicket->getStatus()['name'] . '" => "' . $ticket->getStatus()['name'] . '"';
            break;
        case 'executor_id':
            echo "Ответственный: ";
            echo '"';
            echo empty($oldTicket->executor_id) ? '-' : $oldTicket->executor->name;
            echo '" => "';
            echo empty($ticket->executor_id) ? '-' : $ticket->executor->name;
            echo '"';
            break;
        default:
            continue 2;
            break;
    }
    echo "\n";
}
echo "\n";
echo $ticket->getUrl();
