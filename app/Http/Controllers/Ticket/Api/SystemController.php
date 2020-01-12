<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Models\Ticket;

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
        ];
    }
}
