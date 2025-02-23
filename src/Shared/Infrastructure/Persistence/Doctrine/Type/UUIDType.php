<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\ValueObject\UUID;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UUIDType extends GuidType
{
    public function getName(): string
    {
        return 'UUIDType';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return null === $value || is_string($value)
            ? $value
            : (string) $value->value();
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return null === $value ? UUID::from('00000000-0000-0000-0000-000000000000') : UUID::from($value);
    }
}
