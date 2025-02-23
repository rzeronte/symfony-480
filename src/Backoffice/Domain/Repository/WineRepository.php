<?php

namespace App\Backoffice\Domain\Repository;

use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Shared\ValueObject\UUID;

interface WineRepository
{
    public function getByIdOrFail(UUID $id): Wine;

    /** @return array<Wine> */
    public function findAll(?int $page, ?int $limit): array;

    public function searchCount(): int;
}
