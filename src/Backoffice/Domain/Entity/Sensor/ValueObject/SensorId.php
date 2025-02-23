<?php

namespace App\Backoffice\Domain\Entity\Sensor\ValueObject;

use App\Shared\ValueObject\UUID;

class SensorId extends UUID
{
    protected string $FIELD = 'id';

    public static function from(string $value): self
    {
        return new self($value);
    }
}
