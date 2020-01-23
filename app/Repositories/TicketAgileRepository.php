<?php

namespace App\Repositories;

use App\Models\Ticket\Agile;

/**
 * Class TicketAgileRepository
 * @package App\Repositories
 */
class TicketAgileRepository extends BaseRepository
{
    /**
     * @return array
     */
    public function getAll()
    {
        $return = [];
        $items = $this->query()
            ->select(['id', 'title'])
            ->get();
        foreach ($items as $item) {
            $return[$item->id] = $item;
        }
        return $return;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Agile::class;
    }
}
