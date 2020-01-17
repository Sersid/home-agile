<?php

namespace App\Repositories;

use App\Models\Ticket\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TicketCommentsRepository
 * @package App\Repositories
 */
class TicketCommentsRepository extends BaseRepository
{
    /**
     * @param int $id
     *
     * @return Builder[]|Collection
     */
    public function getForTicket(int $id)
    {
        return $this->query()
            ->select(['id', 'text', 'created_user_id', 'created_at', 'updated_user_id', 'updated_at'])
            ->where('ticket_id', $id)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Comment::class;
    }
}
