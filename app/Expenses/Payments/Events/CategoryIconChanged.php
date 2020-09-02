<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Icon;
use App\Expenses\Payments\Entity\Category\Id;

class CategoryIconChanged
{
    private Id $id;
    private Icon $icon;

    public function __construct(Id $id, Icon $icon)
    {
        $this->id = $id;
        $this->icon = $icon;
    }
}
