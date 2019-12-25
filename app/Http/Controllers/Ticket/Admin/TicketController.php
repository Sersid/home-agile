<?php

namespace App\Http\Controllers\Ticket\Admin;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Admin
 */
class TicketController extends BaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $tickets = Ticket::query()
            ->select(['id', 'title', 'created_at'])
            ->orderBy('id', 'desc')
            ->paginate(25);
        return view('ticket.admin.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ticket.admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     *
     * @return void
     */
    public function store(TicketRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $ticket = Ticket::query()->findOrFail($id);
        return view('ticket.admin.edit', compact('ticket'));
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
