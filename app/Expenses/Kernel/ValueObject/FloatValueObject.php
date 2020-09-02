<?php

declare(strict_types=1);

namespace App\Expenses\Kernel\ValueObject;

abstract class FloatValueObject
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
