<?php

namespace App\Shared\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;

class UUID
{
    protected string $FIELD = '_FIELD_NAME_';

    protected string $value;

    /**
     * @throws AssertionFailedException
     */
    protected function __construct(string $value)
    {
        $this->setValue($value);
    }

    /** @throws AssertionFailedException */
    public static function from(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @throws AssertionFailedException
     */
    private function setValue(string $value): void
    {
        Assertion::uuid($value, sprintf('%s must be a valid UUID, given: %s', $this->FIELD, $value));

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
