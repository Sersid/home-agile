<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\Models
 */
class Ticket extends Model
{
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
    // статус "Удалён"
    const STATUS_DELETED = 1000;

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
                    'name' => 'Начальный',
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
                self::STATUS_DELETED => [
                    'name' => 'Удалён',
                ],
            ];
        }
        return $statuses;
    }
}
