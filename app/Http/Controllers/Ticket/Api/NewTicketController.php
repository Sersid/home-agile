<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class NewTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TicketRepository $repository
     *
     * @return Builder[]|Collection
     */
    public function index(TicketRepository $repository)
    {
        return $repository->getNew();
    }
}
