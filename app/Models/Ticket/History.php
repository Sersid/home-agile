<?php

namespace App\Models\Ticket;

use Eloquent;

/**
 * Class History
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 * @property integer $user_id
 * @property integer $ticket_id
 * @property string  $old
 * @property string  $new
 * @package App\Models\Ticket
 */
class History extends Eloquent
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'ticket_history';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'ticket_id', 'date', 'new', 'old'];

    /**
     * @return array
     */
    public function getOldDecode()
    {
        return json_decode($this->old, true) ?? [];
    }

    /**
     * @return array
     */
    public function getNewDecode()
    {
        return json_decode($this->new, true) ?? [];
    }
}
