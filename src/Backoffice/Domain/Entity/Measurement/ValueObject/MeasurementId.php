<?php

namespace App\Backoffice\Domain\Entity\Measurement\ValueObject;

use App\Shared\ValueObject\UUID;

class MeasurementId extends UUID
{
    protected string $FIELD = 'id';

    public static function from(string $value): self
    {
        return new self($value);
    }
}
