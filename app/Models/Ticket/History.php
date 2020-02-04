<?php

namespace App\Models\Ticket;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class History
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 * @property integer $user_id
 * @property integer $ticket_id
 * @property string  $changes
 * @package App\Models\Ticket
 */
class History extends Eloquent
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_history';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'ticket_id', 'new', 'old'];
}
