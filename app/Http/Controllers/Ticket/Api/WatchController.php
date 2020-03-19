<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\Ticket\AddWatcherRequest;
use App\Http\Requests\Ticket\WatchRequest;
use App\Repositories\Ticket\WatcherRepository;
use App\Services\Ticket\WatcherService;
use Auth;

/**
 * Class WatchController
 * @package App\Http\Controllers\Ticket\Api
 */
class WatchController extends BaseController
{
    /** @var WatcherService */
    protected $service;
    /** @var WatcherRepository */
    protected $repository;

    public function __construct()
    {
        $this->service = new WatcherService();
        $this->repository = new WatcherRepository();
    }

    /**
     * Подписка на тикет
     *
     * @param WatchRequest $request
     *
     * @return array
     */
    public function watch(WatchRequest $request)
    {
        $ticketId = $request->get('ticket_id');
        $this->service->watch($ticketId, Auth::id());
        return ['watchers' => $this->repository->getWatchers($ticketId)];
    }

    /**
     * Отписка на тикета
     *
     * @param WatchRequest $request
     *
     * @return array
     */
    public function unwatch(WatchRequest $request)
    {
        $ticketId = $request->get('ticket_id');
        $this->service->unwatch($ticketId, Auth::id());
        return ['watchers' => $this->repository->getWatchers($ticketId)];
    }

    /**
     * Отписка на тикета
     *
     * @param AddWatcherRequest $request
     *
     * @return array
     */
    public function addWatcher(AddWatcherRequest $request)
    {
        $ticketId = $request->get('ticket_id');
        $userId = $request->get('user_id');
        $this->service->watch($ticketId, $userId);
        return ['watchers' => $this->repository->getWatchers($ticketId)];
    }
}
