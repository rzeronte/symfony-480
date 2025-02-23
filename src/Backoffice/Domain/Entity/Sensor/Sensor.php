<?php

namespace App\Backoffice\Domain\Entity\Sensor;

use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\UUID;

class Sensor implements \JsonSerializable
{
    private UUID $id;
    private StringNotBlank $name;

    private function __construct(UUID $id, StringNotBlank $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function from(UUID $id, StringNotBlank $name): Sensor
    {
        return new self($id, $name);
    }

    public function getId(): UUID
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
