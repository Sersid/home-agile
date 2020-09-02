<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Payment\Id;

class PaymentCreated
{
    public Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}
