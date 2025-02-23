<?php

namespace App\Tests\Unit\Backoffice\Application\Query\GetWines;

use App\Backoffice\Application\Query\GetWines\GetWinesQuery;
use App\Backoffice\Application\Query\GetWines\GetWinesQueryHandler;
use App\Backoffice\Domain\Entity\Wine\ValueObject\WineId;
use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemoryWineRepository;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\YearNotNullable;
use Assert\AssertionFailedException;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class GetWinesQueryHandlerTest extends TestCase
{
    public function testRetrieveWinesWithEmptyDatabaseMustReturnEmptyData(): void
    {
        $wineRepository = new InMemoryWineRepository();

        $query = new GetWinesQuery();
        $handler = new GetWinesQueryHandler($wineRepository);
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
    public function testRetrieveWinesWithRecordsMustReturnIt(): void
    {
        $wineRepository = new InMemoryWineRepository([
            Wine::from(
                WineId::from('e734f1a0-6226-473a-b2fe-5885b8c1337e'),
                YearNotNullable::from(2024),
                StringNotBlank::from('wine1'),
                new ArrayCollection()
            ),
            Wine::from(
                WineId::from('ce5591d7-452c-4c0f-946d-a1be155f41db'),
                YearNotNullable::from(2014),
                StringNotBlank::from('wine2'),
                new ArrayCollection()
            ),
        ]);

        $query = new GetWinesQuery();
        $handler = new GetWinesQueryHandler($wineRepository);
        $paginator = $handler->__invoke($query);

        $this->assertEquals(json_encode([
            'data' => [
                [
                    'id' => 'e734f1a0-6226-473a-b2fe-5885b8c1337e',
                    'name' => 'wine1',
                    'year' => 2024,
                    'measurements' => [],
                ],
                [
                    'id' => 'ce5591d7-452c-4c0f-946d-a1be155f41db',
                    'name' => 'wine2',
                    'year' => 2014,
                    'measurements' => [],
                ],
            ],
            'page' => 1,
            'numResults' => 2,
            'numPages' => 1,
            'limit' => 100,
        ]), json_encode($paginator->jsonSerialize()));
    }
}
