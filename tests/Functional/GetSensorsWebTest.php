<?php

namespace App\Tests\Functional;

use App\Backoffice\Application\Query\GetSensors\GetSensorsResponse;
use App\Backoffice\Infrastructure\Persistence\Doctrine\Repository\SensorDoctrineRepository;
use App\Tests\ApiWebTestCase;
use Doctrine\ORM\Query\QueryException;
use Symfony\Component\HttpFoundation\Response;

class GetSensorsWebTest extends ApiWebTestCase
{
    /**
     * @throws QueryException
     */
    public function testRetrieveSensorsMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('GET', '/api/sensor');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $sensorRepository = new SensorDoctrineRepository($this->getContainer()->get('doctrine.orm.entity_manager'));

        $currentSensorsResponse = GetSensorsResponse::from(
            $sensorRepository->findAll(null, null),
            1,
            100,
            $sensorRepository->searchCount()
        );

        $this->assertEquals(json_encode([
            'data' => $currentSensorsResponse->results(),
            'page' => $currentSensorsResponse->page(),
            'numResults' => $currentSensorsResponse->numResults(),
            'numPages' => $currentSensorsResponse->numPages(),
            'limit' => $currentSensorsResponse->limit(),
        ]), $client->getResponse()->getContent());
    }
}
