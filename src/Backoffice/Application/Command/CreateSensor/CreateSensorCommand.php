<?php

namespace App\Backoffice\Application\Command\CreateSensor;

use Symfony\Component\Uid\Uuid;

class CreateSensorCommand
{
    private string $id;
    private string $name;

    public function __construct(
        string $id,
        string $name,
    ) {
        $this->id = ('' === $id) ? Uuid::v4() : $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
