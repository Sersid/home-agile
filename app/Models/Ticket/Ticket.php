<?php

namespace App\Models\Ticket;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Ticket model
 * @property integer      $id
 * @property string       $created_at
 * @property string       $updated_at
 * @property string       $deleted_at
 * @property string       $title
 * @property string       $description
 * @property string       $term
 * @property integer      $executor_id
 * @property integer      $priority
 * @property integer      $status
 * @property integer      $created_user_id
 * @property integer      $updated_user_id
 * @property User         $executor
 * @property User         $redactor
 * @property Notification $notification
 * @property User[]       $watcherUsers
 * @package App\Models\Ticket
 */
class Ticket extends Model
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
     * Notification
     * @return HasOne
     */
    public function notification()
    {
        return $this->hasOne(Notification::class);
    }

    /**
     * Comments
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id', 'id');
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
     * Agile
     * @return HasOne
     */
    public function agile()
    {
        return $this->hasOne(Agile::class, 'id', 'agile_id');
    }

    /**
     * Watcher
     * @return HasOne
     */
    public function watch()
    {
        return $this->hasOne(Watcher::class, 'ticket_id', 'id')
            ->where(['user_id' => Auth::id()]);
    }

    /**
     * Подписчики
     * @return BelongsToMany
     */
    public function watcherUsers()
    {
        return $this->belongsToMany(User::class, (new Watcher())->getTable(), 'ticket_id', 'user_id');
    }

    /**
     * @return array
     */
    public function getPriority()
    {
        return self::getPriorities()[$this->priority] ?? ['name' => null, 'color' => null];
    }

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
     * @return array
     */
    public function getStatus()
    {
        return self::getStatuses()[$this->status] ?? ['name' => null, 'color' => null];
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
     * @return UrlGenerator|string
     */
    public function getUrl()
    {
        return url('/') . '/#/agile' . (empty($this->agile_id) ? '' : '-' . $this->agile_id) . '/ticket-' . $this->id;
    }
}
