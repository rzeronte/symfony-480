<?php

namespace App\Backoffice\Domain\Entity\Measurement\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;

class MeasurementColor
{
    protected string $FIELD = 'color';

    private string $value;

    /** @throws AssertionFailedException */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @throws AssertionFailedException
     */
    public static function from(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    /** @throws AssertionFailedException */
    private function setValue(string $value): void
    {
        // Assertion::notBlank($value, $this->FIELD.' cannot be empty');
        // Assertion::contains($value, '#', $this->FIELD.' must be a color format #000000');
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
