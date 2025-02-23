<?php

namespace App\Tests\Unit\Backoffice\Application\Query\GetSensors;

use App\Backoffice\Application\Query\GetSensors\GetSensorsQuery;
use App\Backoffice\Application\Query\GetSensors\GetSensorsQueryHandler;
use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemorySensorRepository;
use App\Shared\ValueObject\StringNotBlank;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class GetSensorsQueryHandlerTest extends TestCase
{
    private InMemorySensorRepository $sensorRepository;

    public function testRetrieveSensorsWithEmptyDatabaseMustReturnEmptyData(): void
    {
        $query = new GetSensorsQuery();
        $handler = new GetSensorsQueryHandler($this->sensorRepository);
        $paginator = $handler->__invoke($query);

        $this->assertEquals(json_encode([
            'data' => [],
            'page' => 1,
            'numResults' => 0,
            'numPages' => 0,
            'limit' => 100,
        ]), json_encode($paginator->jsonSerialize()));
    }

    /**
     * @throws AssertionFailedException
     */
    public function testRetrieveSensorsWithRecordsMustReturnIt(): void
    {
        $this->sensorRepository->save(
            Sensor::from(
                SensorId::from('bdad5364-d60b-4bad-b8b7-c56bc5b285e6'),
                StringNotBlank::from('name'),
            )
        );

        $query = new GetSensorsQuery();
        $handler = new GetSensorsQueryHandler($this->sensorRepository);
        $paginator = $handler->__invoke($query);

        $this->assertEquals(json_encode([
            'data' => [
                [
                    'id' => 'bdad5364-d60b-4bad-b8b7-c56bc5b285e6',
                    'name' => 'name',
                ],
            ],
            'page' => 1,
            'numResults' => 1,
            'numPages' => 1,
            'limit' => 100,
        ]), json_encode($paginator->jsonSerialize()));
    }

    protected function setUp(): void
    {
        $this->sensorRepository = new InMemorySensorRepository();
    }
}
