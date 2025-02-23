<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Wine\ValueObject\WineId;
use App\Shared\Infrastructure\Persistence\Doctrine\Type\UUIDType;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class WineIdType extends UUIDType
{
    public function getName(): string
    {
        return 'WineIdType';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return null === $value ? WineId::from('00000000-0000-0000-0000-000000000000') : WineId::from($value);
    }
}
