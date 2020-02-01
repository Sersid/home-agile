<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\Ticket\WatchRequest;
use App\Models\Ticket\Watcher;
use Auth;

/**
 * Class WatchController
 * @package App\Http\Controllers\Ticket\Api
 */
class WatchController extends BaseController
{
    /**
     * Подписка на тикет
     *
     * @param WatchRequest $request
     * @param Watcher      $watcher
     *
     * @return array
     */
    public function watch(WatchRequest $request, Watcher $watcher)
    {
        return ['is_watch' => $watcher->watch($request->get('ticket_id'), Auth::id())];
    }

    /**
     * Отписка на тикета
     *
     * @param WatchRequest $request
     * @param Watcher      $watcher
     *
     * @return array
     */
    public function unwatch(WatchRequest $request, Watcher $watcher)
    {
        return ['is_watch' => !$watcher->unwatch($request->get('ticket_id'), Auth::id())];
    }
}
