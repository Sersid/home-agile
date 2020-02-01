<?php

namespace App\Services\Ticket;

use App\Models\Ticket\Ticket;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketService
 * @package App\Services
 */
class TicketService extends BaseService
{
    /**
     * @param string      $title
     * @param null|string $agile_id
     *
     * @return Ticket|Model
     */
    public function quickAdd(string $title, $agile_id = null)
    {
        return self::create([
            'title' => $title,
            'agile_id' => $agile_id,
            'priority' => $this->model::PRIORITY_LOW,
            'status' => $this->model::STATUS_NEW,
        ]);
    }

    /**
     * Обновление заголовка и описания
     *
     * @param int         $id
     * @param string      $title
     * @param string|null $description
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateDescription(int $id, string $title, $description)
    {
        return self::update($id, ['title' => $title, 'description' => $description]);
    }

    /**
     * Обновление статуса
     *
     * @param int $id
     * @param int $status
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateStatus(int $id, int $status)
    {
        return self::update($id, ['status' => $status]);
    }

    /**
     * Обновление приоритета
     *
     * @param int $id
     * @param int $priority
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updatePriority(int $id, int $priority)
    {
        return self::update($id, ['priority' => $priority]);
    }

    /**
     * Обновление ответственного
     *
     * @param int $id
     * @param int $executor_id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateExecutor(int $id, int $executor_id)
    {
        return self::update($id, ['executor_id' => $executor_id]);
    }

    /**
     * Обновление срока
     *
     * @param int $id
     * @param int|null $term
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateTerm(int $id, $term)
    {
        $term = !empty($term) ? date('Y-m-d', strtotime($term)) : null;
        return self::update($id, ['term' => $term]);
    }

    /**
     * Обновление доски
     *
     * @param int      $id
     * @param int|null $agile_id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function updateAgile($id, $agile_id)
    {
        return self::update($id, ['agile_id' => $agile_id]);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }
}
