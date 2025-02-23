<?php

namespace App\Tests\Unit\Backoffice\Application\Query\GetWines;

use App\Backoffice\Application\Query\GetWines\GetWinesQuery;
use App\Backoffice\Application\Query\GetWines\GetWinesQueryHandler;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemoryWineRepository;
use PHPUnit\Framework\TestCase;

class GetWinesQueryHandlerTest extends TestCase
{
    private InMemoryWineRepository $wineRepository;

    public function testRetrieveWinesWithEmptyDatabaseMustReturnEmptyData(): void
    {
        $query = new GetWinesQuery();
        $handler = new GetWinesQueryHandler($this->wineRepository);
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
        $this->wineRepository = new InMemoryWineRepository();
    }
}
