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
use App\Repositories\TicketRepository;
use App\Services\Ticket\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class TicketController
 * @package App\Http\Controllers\Ticket\Api
 */
class TicketController extends BaseController
{
    /** @var TicketRepository */
    protected $repository;
    /** @var TicketService */
    protected $service;

    /**
     * TicketController constructor.
     */
    public function __construct()
    {
        $this->repository = new TicketRepository();
        $this->service = new TicketService();
    }

    /**
     * Тикеты на доску
     *
     * @param IndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(IndexRequest $request)
    {
        return $this->respond($this->repository->getForAgile($request->get('id')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuickAddRequest $request
     *
     * @return JsonResponse
     */
    public function store(QuickAddRequest $request)
    {
        $ticket = $this->service->quickAdd($request->get('title'), $request->get('agile_id'));
        return $this->show($ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $ticket = $this->repository->getForShow($id);
        if (empty($ticket)) {
            return $this->respond(['message' => 'Ticket not found'], 404);
        }
        return $this->respond($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int           $id
     * @param UpdateRequest $request
     *
     * @return JsonResponse
     */
    public function update(int $id, UpdateRequest $request)
    {
        $this->service->updateDescription($id, $request->get('title'), $request->get('description'));
        return $this->show($id);
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
     * @param int           $id
     * @param StatusRequest $request
     *
     * @return JsonResponse
     */
    public function status(int $id, StatusRequest $request)
    {
        $this->service->updateStatus($id, $request->get('status'));
        return $this->show($id);
    }

    /**
     * Обновление приоритета тикета
     *
     * @param int             $id
     * @param PriorityRequest $request
     *
     * @return JsonResponse
     */
    public function priority(int $id, PriorityRequest $request)
    {
        $this->service->updatePriority($id, $request->get('priority'));
        return $this->show($id);
    }

    /**
     * Обновление ответственного
     *
     * @param int             $id
     * @param ExecutorRequest $request
     *
     * @return JsonResponse
     */
    public function executor(int $id, ExecutorRequest $request)
    {
        $this->service->updateExecutor($id, $request->get('executor_id'));
        return $this->show($id);
    }

    /**
     * Обновление срока
     *
     * @param int         $id
     * @param TermRequest $request
     *
     * @return JsonResponse
     */
    public function term(int $id, TermRequest $request)
    {
        $this->service->updateTerm($id, $request->get('term'));
        return $this->show($id);
    }

    /**
     * Обновление доски
     *
     * @param int          $id
     * @param AgileRequest $request
     *
     * @return JsonResponse
     */
    public function agile(int $id, AgileRequest $request)
    {
        $this->service->updateAgile($id, $request->get('agile_id'));
        return $this->show($id);
    }
}
