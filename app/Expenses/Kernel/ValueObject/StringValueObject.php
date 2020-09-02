<?php

declare(strict_types=1);

namespace App\Expenses\Kernel\ValueObject;

abstract class StringValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
