<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService
{
    /** @var Model */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass();

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        return $this->model::create($data);
    }

    /**
     * @param int   $id
     * @param array $attributes
     * @param array $options
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update(int $id, array $attributes = [], array $options = [])
    {
        $model = $this->model::query()
            ->findOrFail($id);
        $model->update($attributes, $options);
        return $model;
    }

    /**
     * @param int $id
     *
     * @return int
     */
    public function remove(int $id)
    {
        return $this->model::destroy($id);
    }
}
