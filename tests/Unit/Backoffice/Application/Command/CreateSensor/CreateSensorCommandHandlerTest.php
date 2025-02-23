<?php

namespace App\Tests\Unit\Backoffice\Application\Command\CreateSensor;

use App\Backoffice\Application\Command\CreateSensor\CreateSensorCommand;
use App\Backoffice\Application\Command\CreateSensor\CreateSensorCommandHandler;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemorySensorRepository;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CreateSensorCommandHandlerTest extends TestCase
{
    private InMemorySensorRepository $sensorRepository;

    /**
     * @throws AssertionFailedException
     */
    public function testCreateSensorWithGoodArgumentsMustCreateOneSensor(): void
    {
        $productsInitial = $this->sensorRepository->searchCount();

        $command = new CreateSensorCommand(
            Uuid::v4(),
            'Sensor example name'
        );

        (new CreateSensorCommandHandler($this->sensorRepository))($command);

        $this->assertEquals($productsInitial + 1, $this->sensorRepository->searchCount());
    }

    protected function setUp(): void
    {
        $this->sensorRepository = new InMemorySensorRepository();
    }
}
