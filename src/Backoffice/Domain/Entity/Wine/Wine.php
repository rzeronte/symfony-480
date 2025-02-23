<?php

namespace App\Backoffice\Domain\Entity\Wine;

use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\UUID;
use App\Shared\ValueObject\YearNotNullable;
use Doctrine\Common\Collections\Collection;

class Wine implements \JsonSerializable
{
    private UUID $id;
    private YearNotNullable $year;

    private StringNotBlank $name;

    private Collection $measurements;

    public function __construct(UUID $id, YearNotNullable $year, StringNotBlank $name, Collection $measurements)
    {
        $this->id = $id;
        $this->year = $year;
        $this->name = $name;
        $this->measurements = $measurements;
    }

    public static function from(UUID $id, YearNotNullable $year, StringNotBlank $name, Collection $measurements): Wine
    {
        return new self($id, $year, $name, $measurements);
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getYear(): YearNotNullable
    {
        return $this->year;
    }

    public function getName(): StringNotBlank
    {
        return $this->name;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'year' => $this->year->value(),
            'measurements' => $this->measurements->toArray(),
        ];
    }

    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }
}
