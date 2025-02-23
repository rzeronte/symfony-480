<?php

namespace App\Backoffice\Domain\Entity\Wine\ValueObject;

use App\Shared\ValueObject\UUID;

class WineId extends UUID
{
    protected string $FIELD = 'id';

    public static function from(string $value): self
    {
        return new self($value);
    }
}
