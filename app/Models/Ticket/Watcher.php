<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Repositories\Ticket\WatcherRepository;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Наблюдатели
 * @package App\Models\Ticket
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
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
