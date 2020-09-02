<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Events;

use App\Expenses\Payments\Entity\Payment\Id;
use App\Expenses\Payments\Entity\Payment\Sum;

class PaymentSumChanged
{
    public Id $id;
    private Sum $sum;

    public function __construct(Id $id, Sum $sum)
    {
        $this->id = $id;
        $this->sum = $sum;
    }
}
