<?php

namespace App\Models\Ticket;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 * @property integer $ticket_id
 * @property string  $text
 * @property integer $created_user_id
 * @property integer $updated_user_id
 */
class Comment extends Eloquent
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_comments';

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'text', 'created_user_id', 'updated_user_id'];

    /**
     * @param int    $ticket_id
     * @param string $text
     *
     * @return Comment|Model
     */
    public function add(int $ticket_id, string $text)
    {
        return self::create([
            'ticket_id' => $ticket_id,
            'text' => $text,
            'created_user_id' => Auth::id(),
        ]);
    }
}
