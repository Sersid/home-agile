<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket\Agile;
use App\Repositories\BaseRepository;

/**
 * Class AgileRepository
 * @package App\Repositories\Ticket
 */
class AgileRepository extends BaseRepository
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
