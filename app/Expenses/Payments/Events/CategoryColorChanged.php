<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Color;
use App\Expenses\Payments\Entity\Category\Id;

class CategoryColorChanged
{
    private Id $id;
    private Color $color;

    public function __construct(Id $id, Color $color)
    {
        $this->id = $id;
        $this->color = $color;
    }
}
