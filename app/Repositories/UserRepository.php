<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
{
    /**
     * Все пользователи
     * @return array
     */
    public function getAll()
    {
        $return = [];
        $users = $this->query()
            ->select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        foreach ($users as $user) {
            $return[$user->id] = $user;
            $return[$user->id]['avatar'] = $user->avatar();
        }
        return $return;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return User::class;
    }
}
