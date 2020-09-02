<?php
declare(strict_types=1);

namespace App\Expenses\Kernel\Aggregate;

interface AggregateRoot
{
    /**
     * @return array
     */
    public function releaseEvents(): array;
}
