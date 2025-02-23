<?php

namespace App\Shared\ValueObject;

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

    private function setValue(int $value): void
    {
        $this->value = $value;
    }
}
