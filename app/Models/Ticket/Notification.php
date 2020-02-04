<?php

namespace App\Models\Ticket;

use Eloquent;

/**
 * Модель уведомлений
 * @package App\Models\Ticket
 * @property int    $ticket_id
 * @property string $on_changed
 */
class Notification extends Eloquent
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_notifications';
    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'on_changed'];
}
