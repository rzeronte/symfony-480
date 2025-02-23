<?php

namespace App\Backoffice\Domain\Entity\Sensor;

use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Shared\ValueObject\StringNotBlank;

class Sensor implements \JsonSerializable
{
    private SensorId $id;
    private StringNotBlank $name;

    private function __construct(SensorId $id, StringNotBlank $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function from(SensorId $id, StringNotBlank $name): Sensor
    {
        return new self($id, $name);
    }

    public function getId(): SensorId
    {
        return $this->id;
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
        ];
    }
}
