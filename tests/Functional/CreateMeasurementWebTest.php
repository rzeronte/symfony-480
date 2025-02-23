<?php

namespace App\Tests\Functional;

use App\DataFixtures\SensorFixtures;
use App\DataFixtures\WineFixtures;
use App\Tests\ApiWebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class CreateMeasurementWebTest extends ApiWebTestCase
{
    public function testCreateMeasurementWithBadRequestMustFail(): void
    {
        $client = $this->getClientForTestingUser();

        // empty body
        $client->jsonRequest('POST', '/api/measurement');
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // bad uuids
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => '',
            'sensor_id' => '',
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // bad year
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'year' => 0,
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // not found wine
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => Uuid::v4(),
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'year' => date('Y'),
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // not found sensor
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => Uuid::v4(),
            'year' => date('Y'),
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // bad alcohol_content
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'year' => date('Y'),
            'alcohol_content' => -1,
        ]);

        // bad ph
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'year' => date('Y'),
            'ph' => -1,
        ]);

        // bad color
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'color' => 'rojo',
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testCreateMeasurementWithGoodDataMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => WineFixtures::$wines[0]['id'],
            'sensor_id' => SensorFixtures::$sensors[0]['id'],
            'year' => 2000,
            'color' => '#112233',
            'temperature' => 9,
            'alcohol_content' => 0.1,
            'ph' => 1.1,
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
