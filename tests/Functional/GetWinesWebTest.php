<?php

namespace App\Tests\Functional;

use App\Backoffice\Application\Query\GetWines\GetWinesResponse;
use App\Backoffice\Infrastructure\Persistence\Doctrine\Repository\WineDoctrineRepository;
use App\Tests\ApiWebTestCase;
use Doctrine\ORM\Query\QueryException;
use Symfony\Component\HttpFoundation\Response;

class GetWinesWebTest extends ApiWebTestCase
{
    /**
     * @throws QueryException
     */
    public function testRetrieveWinesMustReturnOk(): void
    {
        $client = $this->getClientForTestingUser();
        $client->jsonRequest('GET', '/api/wine');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $wineRepository = new WineDoctrineRepository($this->getContainer()->get('doctrine.orm.entity_manager'));

        $currentWinesResponse = GetWinesResponse::from(
            $wineRepository->findAll(null, null),
            1,
            100,
            $wineRepository->searchCount()
        );

        $this->assertEquals(json_encode([
            'data' => $currentWinesResponse->results(),
            'page' => $currentWinesResponse->page(),
            'numResults' => $currentWinesResponse->numResults(),
            'numPages' => $currentWinesResponse->numPages(),
            'limit' => $currentWinesResponse->limit(),
        ]), $client->getResponse()->getContent());
    }
}
