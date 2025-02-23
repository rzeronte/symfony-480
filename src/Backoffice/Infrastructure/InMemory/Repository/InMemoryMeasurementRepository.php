<?php

namespace App\Backoffice\Infrastructure\InMemory\Repository;

use App\Backoffice\Domain\Entity\Measurement\Measurement;
use App\Backoffice\Domain\Repository\MeasurementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

class InMemoryMeasurementRepository implements MeasurementRepository
{
    private Collection $measurements;

    /**
     * @param array<Measurement> $measurements
     */
    public function __construct(array $measurements = [])
    {
        $this->measurements = new ArrayCollection([]);

        foreach ($measurements as $measurement) {
            $this->save($measurement);
        }
    }

    public function save(Measurement $measurement): void
    {
        $this->measurements->set($measurement->getId()->value(), $measurement);
    }

    public function count(): int
    {
        $results = $this->measurements;
        $criteria = Criteria::create();

        return $results->matching($criteria)->count();
    }
}
