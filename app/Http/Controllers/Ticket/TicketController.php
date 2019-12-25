<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends BaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $tickets = Ticket::query()
            ->where(['status' => Ticket::STATUS_NEW])
            ->get();
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //
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
        dd($request->all());
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
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
