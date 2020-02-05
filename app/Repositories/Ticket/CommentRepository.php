<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket\Comment;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentRepository
 * @package App\Repositories\Ticket
 */
class CommentRepository extends BaseRepository
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
     * @param int $id
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getForNotify(int $id)
    {
        return $this->query()
            ->with(['ticket', 'ticket.watcherUsers'])
            ->find($id);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Comment::class;
    }
}
