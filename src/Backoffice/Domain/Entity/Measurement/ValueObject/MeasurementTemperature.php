<?php

namespace App\Backoffice\Domain\Entity\Measurement\ValueObject;

use App\Shared\ValueObject\FloatNotNullable;

class MeasurementTemperature extends FloatNotNullable
{
    public static function from(float $value): self
    {
        return new self($value);
    }
}
