<?php

namespace App\Backoffice\Domain\Repository;

use App\Backoffice\Domain\Entity\Measurement\Measurement;

interface MeasurementRepository
{
    public function save(Measurement $measurement): void;
}
