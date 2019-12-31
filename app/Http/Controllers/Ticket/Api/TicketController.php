<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class TicketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param TicketRepository $repository
     *
     * @return Response
     */
    public function index(TicketRepository $repository)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @param Ticket        $ticket
     *
     * @return Ticket|Model
     */
    public function store(TicketRequest $request, Ticket $ticket)
    {
        return $ticket->quickAdd($request->get('title'));
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
