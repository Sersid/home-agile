<?php

namespace App\Models\Ticket;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Agile
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 * @property string  $title
 * @property integer $created_user_id
 * @property integer $updated_user_id
 * @package App\Models\Ticket
 */
class Agile extends Eloquent
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_agiles';

    /**
     * @var array
     */
    protected $fillable = ['title', 'created_user_id', 'updated_user_id'];

    /**
     * @param string $title
     *
     * @return Ticket|Model
     */
    public function add(string $title)
    {
        return self::create([
            'title' => $title,
            'created_user_id' => Auth::id(),
        ]);
    }
}
