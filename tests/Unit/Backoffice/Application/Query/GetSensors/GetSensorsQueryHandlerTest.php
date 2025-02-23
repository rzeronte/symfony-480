<?php

namespace App\Tests\Unit\Backoffice\Application\Query\GetSensors;

use App\Backoffice\Application\Query\GetSensors\GetSensorsQuery;
use App\Backoffice\Application\Query\GetSensors\GetSensorsQueryHandler;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemorySensorRepository;
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

    protected function setUp(): void
    {
        $this->sensorRepository = new InMemorySensorRepository();
    }
}
