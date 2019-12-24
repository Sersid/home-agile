<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Ticket model
 * @property integer id
 * @property integer created_at
 * @property integer updated_at
 * @property integer deleted_at
 * @property string  title
 * @property string  description
 * @property integer term
 * @property integer executor_id
 * @property integer priority
 * @property integer status
 * @property integer created_user_id
 * @property integer updated_user_id
 * @package App\Models
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
     * Приоритеты
     * @return array
     */
    public static function getPriorities(): array
    {
        static $priorities;
        if (is_null($priorities)) {
            $priorities = [
                self::PRIORITY_LOW => [
                    'name' => 'Низкий',
                ],
                self::PRIORITY_MEDIUM => [
                    'name' => 'Средний',
                ],
                self::PRIORITY_HIGH => [
                    'name' => 'Высокий',
                ],
            ];
        }
        return $priorities;
    }

    /**
     * Статусы
     * @return array
     */
    public static function getStatuses(): array
    {
        static $statuses;
        if (is_null($statuses)) {
            $statuses = [
                self::STATUS_NEW => [
                    'name' => 'Новый',
                ],
                self::STATUS_IN_WORK => [
                    'name' => 'В работе',
                ],
                self::STATUS_BLOCKED => [
                    'name' => 'Заблокирован',
                ],
                self::STATUS_DONE => [
                    'name' => 'Выполнен',
                ],
                self::STATUS_ARCHIVE => [
                    'name' => 'В архиве',
                ],
            ];
        }
        return $statuses;
    }

    /**
     * Author
     * @return HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }
}
