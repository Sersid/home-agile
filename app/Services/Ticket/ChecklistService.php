<?php

namespace App\Services\Ticket;

use App\Models\Ticket\Checklist;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChecklistService
 * @package App\Services\Ticket
 */
class ChecklistService extends BaseService
{
    /**
     * @param int    $ticket_id
     * @param string $title
     *
     * @return mixed
     */
    public function add(int $ticket_id, string $title)
    {
        return $this->create([
            'ticket_id' => $ticket_id,
            'title' => $title,
        ]);
    }

    /**
     * @param int    $id
     * @param string $title
     * @param bool   $status
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateTitleAndStatus(int $id, string $title, bool $status)
    {
        return $this->update($id,
            [
                'title' => $title,
                'status' => $status ? Checklist::STATUS_CHECKED : Checklist::STATUS_UNCHECKED,
            ]);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Checklist::class;
    }
}
