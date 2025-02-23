<?php

namespace App\Tests\Functional;

use App\Tests\ApiWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateSensorWebTest extends ApiWebTestCase
{
    public function testCreateSensorWithGoodDataMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('POST', '/api/sensor', [
            'name' => 'test',
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
