<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Category\Category;
use App\Expenses\Payments\Entity\Payment\Id;

class PaymentCategoryChanged
{
    public Id $id;
    private ?Category $category;

    public function __construct(Id $id, ?Category $category)
    {
        $this->id = $id;
        $this->category = $category;
    }
}
