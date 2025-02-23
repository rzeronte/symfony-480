<?php

namespace App\Backoffice\Application\Query\GetSensors;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Shared\Application\PaginationResponse;

class GetSensorsResponse extends PaginationResponse
{
    /**
     * @param array<Sensor> $results
     */
    private function __construct(array $results, int $page, int $limit, int $numResults)
    {
        parent::__construct($results, $page, $limit, $numResults);
    }

    /**
     * @param array<Sensor> $results
     */
    public static function from(array $results, int $page, int $limit, int $numResults): self
    {
        return new self($results, $page, $limit, $numResults);
    }
}
