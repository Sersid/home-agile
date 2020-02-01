<?php

namespace App\Models\Ticket;

use App\Repositories\TicketWatcherRepository;
use Eloquent;
use Exception;
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
     * @param int      $ticket_id
     * @param int|null $user_id
     *
     * @return bool
     */
    public function watch(int $ticket_id, int $user_id)
    {
        $item = (new TicketWatcherRepository)->getItem($ticket_id, $user_id);
        if (!empty($item)) {
            if ($item->trashed()) {
                $item->restore();
            }
            return true;
        }
        self::create([
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
        ]);
        return true;
    }

    /**
     * @param int $ticket_id
     * @param int $user_id
     *
     * @return bool
     */
    public function unwatch(int $ticket_id, int $user_id)
    {
        $item = (new TicketWatcherRepository)->getItem($ticket_id, $user_id);
        if (empty($item)) {
            return true;
        }
        if (!$item->trashed()) {
            try {
                $item->delete();
            } catch (Exception $e) {
                return false;
            }
        }
        return true;
    }
}
