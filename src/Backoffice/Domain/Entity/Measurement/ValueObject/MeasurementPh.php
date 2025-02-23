<?php

namespace App\Backoffice\Domain\Entity\Measurement\ValueObject;

use App\Shared\ValueObject\FloatNotNullable;
use Assert\Assertion;
use Assert\AssertionFailedException;

class MeasurementPh extends FloatNotNullable
{
    /** @throws AssertionFailedException */
    public static function from(float $value): self
    {
        Assertion::greaterOrEqualThan($value, 0);

        return new self($value);
    }
}
