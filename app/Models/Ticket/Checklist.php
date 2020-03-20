<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Checklist model
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $title
 * @property integer $ticket_id
 * @property integer $status
 * @property integer $created_user_id
 * @property integer $updated_user_id
 * @property User    $executor
 * @property User    $redactor
 * @package App\Models\Ticket
 */
class Checklist extends Model
{
    const STATUS_UNCHECKED = 100;
    const STATUS_CHECKED = 200;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_checklists';

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'status', 'title'];

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
     * Redactor
     * @return HasOne
     */
    public function redactor()
    {
        return $this->hasOne(User::class, 'id', 'updated_user_id');
    }
}
