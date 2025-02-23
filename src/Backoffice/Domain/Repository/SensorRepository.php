<?php

namespace App\Backoffice\Domain\Repository;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Shared\ValueObject\UUID;

interface SensorRepository
{
    public function getByIdOrFail(UUID $from): Sensor;

    public function searchCount(): int;

    /**
     * @return array<Sensor>
     */
    public function findAll(?int $page, ?int $limit): array;

    public function save(Sensor $sensor): void;
}
