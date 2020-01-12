<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketRepository
 * @package App\Repositories
 */
class TicketRepository extends BaseRepository
{
    /**
     * Новые тикеты
     * @return LengthAwarePaginator
     */
    public function getLast()
    {
        return $this->query()
            ->select(['id', 'title', 'created_user_id'])
            ->where('status', Ticket::STATUS_NEW)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return Builder|Model|object|null
     */
    public function getForShow(int $id)
    {
        return $this->query()
            ->select([
                'id',
                'title',
                'description',
            ])
            ->find($id);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }
}
