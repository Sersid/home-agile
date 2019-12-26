<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Repositories\TicketRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class NewTicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param TicketRepository $repository
     *
     * @return LengthAwarePaginator
     */
    public function index(TicketRepository $repository)
    {
        return $repository->getNew();
    }
}
