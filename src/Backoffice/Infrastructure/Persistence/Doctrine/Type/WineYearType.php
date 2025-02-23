<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\ValueObject\YearNotNullable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class WineYearType extends IntegerType
{
    public function getName(): string
    {
        return 'WineYearType';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): YearNotNullable|int|null
    {
        return null === $value ? YearNotNullable::from(date('Y')) : YearNotNullable::from($value);
    }

    public function getClassName(): string
    {
        return YearNotNullable::class;
    }
}
