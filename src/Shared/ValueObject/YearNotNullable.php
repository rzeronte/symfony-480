<?php

namespace App\Shared\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;

class YearNotNullable
{
    protected int $value;

    protected function __construct(int $value)
    {
        $this->setValue($value);
    }

    public static function from(int $value): self
    {
        return new self($value);
    }

    final public function value(): int
    {
        return $this->value;
    }

    /**
     * @throws AssertionFailedException
     */
    private function setValue(int $value): void
    {
        Assertion::greaterThan($value, 0);
        $this->value = $value;
    }
}
