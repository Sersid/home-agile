<?php

namespace App\Models\Ticket;

use App\Models\User;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ticket
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
 * @package App\Models\Ticket
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
        'agile_id',
        'term',
        'executor_id',
        'priority',
        'status',
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
                'color' => 'warning',
            ],
            self::PRIORITY_HIGH => [
                'name' => 'Высокий',
                'color' => 'danger',
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
     * @param null|string   $agile_id
     *
     * @return Ticket|Model
     */
    public function quickAdd(string $title, $agile_id = null)
    {
        return self::create([
            'title' => $title,
            'agile_id' => $agile_id,
            'priority' => self::PRIORITY_LOW,
            'status' => self::STATUS_NEW,
        ]);
    }

    /**
     * Обновление заголовка и описания
     * @param string $title
     * @param string|null $description
     *
     * @return bool
     */
    public function updateDescription(string $title, $description)
    {
        return $this->update([
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Обновление статуса
     * @param int $status
     *
     * @return bool
     */
    public function updateStatus(int $status)
    {
        return $this->update([
            'status' => $status,
        ]);
    }

    /**
     * Обновление приоритета
     * @param int $priority
     *
     * @return bool
     */
    public function updatePriority(int $priority)
    {
        return $this->update([
            'priority' => $priority,
        ]);
    }

    /**
     * Обновление ответственного
     *
     * @param int $executor_id
     *
     * @return bool
     */
    public function updateExecutor(int $executor_id)
    {
        return $this->update([
            'executor_id' => $executor_id,
        ]);
    }

    /**
     * Обновление срока
     *
     * @param int $term
     *
     * @return bool
     */
    public function updateTerm($term)
    {
        $term = !empty($term) ? date('Y-m-d', strtotime($term)) : null;
        return $this->update([
            'term' => $term,
        ]);
    }

    /**
     * Обновление доски
     *
     * @param int $id
     *
     * @return bool
     */
    public function updateAgile($id)
    {
        return $this->update([
            'agile_id' => $id,
        ]);
    }
}
