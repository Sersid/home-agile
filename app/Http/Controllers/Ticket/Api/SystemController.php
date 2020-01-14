<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Models\Ticket;
use App\Repositories\UserRepository;

/**
 * Class SystemController
 * @package App\Http\Controllers\Ticket\Api
 */
class SystemController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        return [
            'statuses' => Ticket::getStatuses(),
            'priorities' => Ticket::getPriorities(),
            'users' => (new UserRepository)->getAll(),
        ];
    }
}
