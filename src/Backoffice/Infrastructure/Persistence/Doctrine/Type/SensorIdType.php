<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Shared\Infrastructure\Persistence\Doctrine\Type\UUIDType;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class SensorIdType extends UUIDType
{
    public function getName(): string
    {
        return 'SensorIdType';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return null === $value ? SensorId::from('00000000-0000-0000-0000-000000000000') : SensorId::from($value);
    }
}
