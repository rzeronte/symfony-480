<?php

namespace App\Backoffice\Application\Command\CreateSensor;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Repository\SensorRepository;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\UUID;
use Assert\AssertionFailedException;

class CreateSensorCommandHandler
{
    private SensorRepository $sensorRepository;

    public function __construct(SensorRepository $sensorRepository)
    {
        $this->sensorRepository = $sensorRepository;
    }

    /**
     * @throws AssertionFailedException
     */
    public function __invoke(CreateSensorCommand $command): void
    {
        $sensor = Sensor::from(
            UUID::from($command->getId()),
            StringNotBlank::from($command->getName()),
        );

        $this->sensorRepository->save($sensor);
    }
}
