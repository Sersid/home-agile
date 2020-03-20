<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Requests\Ticket\Checklist\StoreChecklistRequest;
use App\Http\Requests\Ticket\Checklist\UpdateChecklistRequest;
use App\Services\Ticket\ChecklistService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChecklistController
 * @package App\Http\Controllers\Ticket\Api
 */
class ChecklistController extends BaseController
{
    /** @var ChecklistService */
    protected $service;

    public function __construct()
    {
        $this->service = new ChecklistService();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreChecklistRequest $request
     *
     * @return Model
     */
    public function store(StoreChecklistRequest $request)
    {
        return $this->service->add($request->get('ticket_id'), $request->get('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateChecklistRequest $request
     * @param int                    $id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update(UpdateChecklistRequest $request, int $id)
    {
        return $this->service->updateTitleAndStatus($id, $request->get('title'), $request->get('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return int
     */
    public function destroy(int $id)
    {
        return $this->service->remove($id);
    }
}
