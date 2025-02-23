<?php

declare(strict_types=1);

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\ValueObject\StringNotBlank;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class WineNameType extends StringType
{
    /** @throws AssertionFailedException */
    public function convertToPHPValue($value, AbstractPlatform $platform): StringNotBlank
    {
        return StringNotBlank::from((string) $value);
    }

    public function getName(): string
    {
        return 'WineNameType';
    }
}
