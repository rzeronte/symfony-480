<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementAlcoholContent;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class MeasurementAlcoholContentType extends StringType
{
    public function getName(): string
    {
        return 'MeasurementAlcoholContentType';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): float
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): object
    {
        return MeasurementAlcoholContent::from((float) $value);
    }

    public function getClassName(): string
    {
        return MeasurementAlcoholContent::class;
    }
}
