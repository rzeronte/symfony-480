<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementTemperature;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class MeasurementTemperatureType extends StringType
{
    public function getName(): string
    {
        return 'MeasurementTemperatureType';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): float
    {
        return $value->value();
    }

    /**
     * @throws AssertionFailedException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return MeasurementTemperature::from((float) $value);
    }

    public function getClassName(): string
    {
        return MeasurementTemperature::class;
    }
}
