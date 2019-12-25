<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TicketRepository
 * @package App\Repositories
 */
class TicketRepository extends BaseRepository
{
    /**
     * Новые тикеты
     * @return Builder[]|Collection
     */
    public function getNew()
    {
        return $this->query()
            ->select(['id', 'title', 'created_user_id'])
            ->where('status', Ticket::STATUS_NEW)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }
}
