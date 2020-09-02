<?php

declare(strict_types=1);

namespace App\Expenses\Kernel\ValueObject;

abstract class IntValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
