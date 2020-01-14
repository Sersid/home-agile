<?php

namespace App\Models;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Ticket model
 * @property integer $id
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $deleted_at
 * @property string  $title
 * @property string  $description
 * @property string  $term
 * @property integer $executor_id
 * @property integer $priority
 * @property integer $status
 * @property integer $created_user_id
 * @property integer $updated_user_id
 * @package App\Models
 */
class Ticket extends Eloquent
{
    use SoftDeletes;

    // низкий приоритет
    const PRIORITY_LOW = 100;
    // средний приоритет
    const PRIORITY_MEDIUM = 200;
    // высокий приоритет
    const PRIORITY_HIGH = 300;

    // статус "Начальный"
    const STATUS_NEW = 100;
    // статус "В работе"
    const STATUS_IN_WORK = 200;
    // статус "Заблокирован"
    const STATUS_BLOCKED = 300;
    // статус "Выполнен"
    const STATUS_DONE = 400;
    // статус "В архиве"
    const STATUS_ARCHIVE = 500;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'term',
        'executor_id',
        'priority',
        'status',
        'created_user_id',
        'updated_user_id',
    ];

    /**
     * Приоритеты
     * @return array
     */
    public static function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW => [
                'name' => 'Низкий',
                'color' => 'secondary',
            ],
            self::PRIORITY_MEDIUM => [
                'name' => 'Средний',
                'color' => 'info',
            ],
            self::PRIORITY_HIGH => [
                'name' => 'Высокий',
                'color' => 'warning',
            ],
        ];
    }

    /**
     * Статусы
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => [
                'name' => 'Новый',
                'color' => 'info',
            ],
            self::STATUS_IN_WORK => [
                'name' => 'В работе',
                'color' => 'warning',
            ],
            self::STATUS_BLOCKED => [
                'name' => 'Заблокирован',
                'color' => 'danger',
            ],
            self::STATUS_DONE => [
                'name' => 'Выполнен',
                'color' => 'success',
            ],
            self::STATUS_ARCHIVE => [
                'name' => 'В архиве',
                'color' => 'secondary',
            ],
        ];
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
     * Executor
     * @return HasOne
     */
    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'executor_id');
    }

    /**
     * Redactor
     * @return HasOne
     */
    public function redactor()
    {
        return $this->hasOne(User::class, 'id', 'updated_user_id');
    }

    /**
     * @param string $title
     *
     * @return Ticket|Model
     */
    public function quickAdd(string $title)
    {
        return self::create([
            'title' => $title,
            'priority' => self::PRIORITY_LOW,
            'status' => self::STATUS_NEW,
            'created_user_id' => Auth::id(),
        ]);
    }

    /**
     * @param string $title
     * @param string $description
     *
     * @return bool
     */
    public function updateDescription(string $title, string $description)
    {
        return $this->update([
            'title' => $title,
            'description' => $description,
            'updated_user_id' => Auth::id(),
        ]);
    }
}
