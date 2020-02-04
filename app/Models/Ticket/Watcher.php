<?php

namespace App\Models\Ticket;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Наблюдатели
 * @package App\Models\Ticket
 * @property int  $ticket_id
 * @property int  $user_id
 * @property User $user
 */
class Watcher extends Eloquent
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_watchers';

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id'];

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
