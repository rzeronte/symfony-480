<?php

declare(strict_types=1);

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementColor;
use Assert\AssertionFailedException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class MeasurementColorType extends StringType
{
    /** @throws AssertionFailedException */
    public function convertToPHPValue($value, AbstractPlatform $platform): MeasurementColor
    {
        return null === $value ? MeasurementColor::from('#000000') : MeasurementColor::from($value);
    }

    public function getName(): string
    {
        return 'MeasurementColorType';
    }
}
