<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Id;
use App\Expenses\Payments\Entity\Category\Name;

class CategoryRenamed
{
    private Id $id;
    private Name $name;

    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
