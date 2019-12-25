<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class TicketController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
