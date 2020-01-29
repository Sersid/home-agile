<?php

namespace App\Observers;

use App\Models\Ticket\Ticket;
use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseObserver
 * @package App\Observers
 */
class BaseObserver
{
    /**
     * @param Model $model
     */
    public function setAuthor(Model $model)
    {
        $model->created_user_id = Auth::id();
    }

    /**
     * @param Model $model
     */
    public function setRedactor(Model $model)
    {
        $model->updated_user_id = Auth::id();
    }
}
