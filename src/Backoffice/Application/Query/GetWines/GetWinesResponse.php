<?php

namespace App\Backoffice\Application\Query\GetWines;

use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Shared\Application\PaginationResponse;

class GetWinesResponse extends PaginationResponse
{
    /**
     * @param array<Wine> $results
     */
    private function __construct(array $results, int $page, int $limit, int $numResults)
    {
        parent::__construct($results, $page, $limit, $numResults);
    }

    /**
     * @param array<Wine> $results
     */
    public static function from(array $results, int $page, int $limit, int $numResults): self
    {
        return new self($results, $page, $limit, $numResults);
    }
}
