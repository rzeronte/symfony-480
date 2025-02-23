<?php

namespace App\Tests\Functional;

use App\Tests\ApiWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateMeasurementWebTest extends ApiWebTestCase
{
    public function testCreateMeasurementWithGoodDataMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('POST', '/api/measurement', [
            'wine_id' => 'a461d3c1-fb43-4d76-ba30-617af7021764',
            'sensor_id' => 'f2b4b93c-1cee-4523-adfd-67c9b7824058',
            'year' => 2000,
            'color' => '#112233',
            'temperature' => 9,
            'alcohol_content' => 0.1,
            'ph' => 1.1,
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
