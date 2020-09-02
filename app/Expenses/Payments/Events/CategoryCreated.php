<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Id;

class CategoryCreated
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}
