<?php

namespace App\Tests\Functional;

use App\Tests\ApiWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateSensorWebTest extends ApiWebTestCase
{
    public function testCreateSensorWithBadRequestMustFail(): void
    {
        $client = $this->getClientForTestingUser();

        // empty body
        $client->jsonRequest('POST', '/api/sensor');
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // bad uuid
        $client->jsonRequest('POST', '/api/sensor', [
            'id' => '',
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);

        // bad name
        $client->jsonRequest('POST', '/api/sensor', [
            'id' => '',
            'name' => null,
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testCreateSensorWithGoodDataMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('POST', '/api/sensor', [
            'name' => 'test',
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
