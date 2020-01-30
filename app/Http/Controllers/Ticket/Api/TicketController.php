<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\Ticket\AgileRequest;
use App\Http\Requests\Ticket\ExecutorRequest;
use App\Http\Requests\Ticket\IndexRequest;
use App\Http\Requests\Ticket\PriorityRequest;
use App\Http\Requests\Ticket\QuickAddRequest;
use App\Http\Requests\Ticket\StatusRequest;
use App\Http\Requests\Ticket\TermRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Models\Ticket\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class TicketController extends BaseController
{
    /**
     * Тикеты на доску
     *
     * @param IndexRequest     $request
     * @param TicketRepository $repository
     *
     * @return Builder[]|Collection
     */
    public function index(IndexRequest $request, TicketRepository $repository)
    {
        return $repository->getForAgile($request->get('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuickAddRequest $request
     * @param Ticket          $ticket
     *
     * @return Ticket|Model
     */
    public function store(QuickAddRequest $request, Ticket $ticket)
    {
        return $ticket->quickAdd($request->get('title'), $request->get('agile_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param int              $id
     * @param TicketRepository $repository
     *
     * @return Builder|Model|JsonResponse|object|null
     */
    public function show($id, TicketRepository $repository)
    {
        $ticket = $repository->getForShow((int)$id);
        if (empty($ticket)) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Ticket        $ticket
     *
     * @return Ticket
     */
    public function update(UpdateRequest $request, Ticket $ticket)
    {
        $ticket->updateDescription($request->get('title'), $request->get('description'));
        return $ticket;
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

    /**
     * Обновление статуса тикета
     *
     * @param StatusRequest $request
     * @param Ticket        $ticket
     *
     * @return Ticket
     */
    public function status(StatusRequest $request, Ticket $ticket)
    {
        $ticket->updateStatus($request->get('status'));
        return $ticket;
    }

    /**
     * Обновление приоритета тикета
     *
     * @param PriorityRequest $request
     * @param Ticket          $ticket
     *
     * @return Ticket
     */
    public function priority(PriorityRequest $request, Ticket $ticket)
    {
        $ticket->updatePriority($request->get('priority'));
        return $ticket;
    }

    /**
     * Обновление ответственного
     *
     * @param ExecutorRequest $request
     * @param Ticket          $ticket
     *
     * @return Ticket
     */
    public function executor(ExecutorRequest $request, Ticket $ticket)
    {
        $ticket->updateExecutor($request->get('executor_id'));
        return $ticket;
    }

    /**
     * Обновление срока
     *
     * @param TermRequest $request
     * @param Ticket      $ticket
     *
     * @return Ticket
     */
    public function term(TermRequest $request, Ticket $ticket)
    {
        $ticket->updateTerm($request->get('term'));
        return $ticket;
    }

    /**
     * Обновление доски
     *
     * @param AgileRequest $request
     * @param Ticket       $ticket
     *
     * @return Ticket
     */
    public function agile(AgileRequest $request, Ticket $ticket)
    {
        $ticket->updateAgile($request->get('agile_id'));
        return $ticket;
    }
}
