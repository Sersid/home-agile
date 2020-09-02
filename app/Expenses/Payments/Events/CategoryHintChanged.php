<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Hint;
use App\Expenses\Payments\Entity\Category\Id;

class CategoryHintChanged
{
    private Id $id;
    private Hint $hint;

    public function __construct(Id $id, Hint $hint)
    {
        $this->id = $id;
        $this->hint = $hint;
    }
}
