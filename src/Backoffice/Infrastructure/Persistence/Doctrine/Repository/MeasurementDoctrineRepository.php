<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Repository;

use App\Backoffice\Domain\Entity\Measurement\Measurement;
use App\Backoffice\Domain\Repository\MeasurementRepository;
use Doctrine\ORM\EntityManagerInterface;

class MeasurementDoctrineRepository implements MeasurementRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Measurement $measurement): void
    {
        $this->entityManager->persist($measurement);
        $this->entityManager->flush();
    }
}
