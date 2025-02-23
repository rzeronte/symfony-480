<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementId;
use App\Shared\Infrastructure\Persistence\Doctrine\Type\UUIDType;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class MeasurementIdType extends UUIDType
{
    public function getName(): string
    {
        return 'MeasurementIdType';
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return null === $value ? MeasurementId::from('00000000-0000-0000-0000-000000000000') : MeasurementId::from($value);
    }
}
