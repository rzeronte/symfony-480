<?php

namespace App\Backoffice\Application\Query\GetSensors;

class GetSensorsQuery
{
    private const int DEFAULT_PAGE = 1;

    private const int DEFAULT_LIMIT = 100;

    private int $page;

    private int $limit;

    public function __construct(?int $page = null, ?int $limit = null)
    {
        $this->page = $page ?? self::DEFAULT_PAGE;
        $this->limit = $limit ?? self::DEFAULT_LIMIT;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
