<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Repository;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Repository\SensorRepository;
use App\Shared\ValueObject\UUID;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;

class SensorDoctrineRepository implements SensorRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getByIdOrFail(UUID $from): Sensor
    {
        $sensor = $this->entityManager->getRepository(Sensor::class)->find($from->value());

        if (!$sensor) {
            throw new \RuntimeException("Sensor with ID {$from->value()} not found.");
        }

        return $sensor;
    }

    public function searchCount(): int
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('count(c.id)')
            ->from(Sensor::class, 'c');

        return (int) $queryBuilder->getQuery()
            ->getSingleScalarResult();
    }

    /** @return array<mixed>
     * @throws QueryException
     */
    public function findAll(?int $page, ?int $limit): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from(Sensor::class, 'c')
        ;

        $criteria = Criteria::create()->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);

        return $queryBuilder->addCriteria($criteria)
            ->getQuery()
            ->getResult()
        ;
    }

    public function save(Sensor $sensor): void
    {
        $this->entityManager->persist($sensor);
        $this->entityManager->flush();
    }
}
