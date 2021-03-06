<?php

namespace App\Models\Ticket;

use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
 * @property Ticket  $ticket
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
    protected $fillable = ['ticket_id', 'text'];

    /**
     * Ticket
     * @return HasOne
     */
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'id', 'ticket_id');
    }

    /**
     * Author
     * @return HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }

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
        ]);
    }
}
