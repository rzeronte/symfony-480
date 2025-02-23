<?php

namespace App\Backoffice\Infrastructure\Persistence\Doctrine\Repository;

use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Backoffice\Domain\Repository\WineRepository;
use App\Shared\ValueObject\UUID;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WineDoctrineRepository implements WineRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Wine $wine): void
    {
        $this->entityManager->persist($wine);
        $this->entityManager->flush();
    }

    public function getByIdOrFail(UUID $id): Wine
    {
        $sensor = $this->entityManager->getRepository(Wine::class)->find($id->value());

        if (!$sensor) {
            throw new BadRequestHttpException("Doctrine: Wine with ID {$id->value()} not found.");
        }

        return $sensor;
    }

    /**
     * @throws QueryException
     */
    public function findAll(?int $page, ?int $limit): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('w, y')
            ->from(Wine::class, 'w')
            ->leftJoin('w.measurements', 'y')
        ;

        $criteria = Criteria::create()->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);

        return $queryBuilder->addCriteria($criteria)
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchCount(): int
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('count(c.id)')
            ->from(Wine::class, 'c');

        return (int) $queryBuilder->getQuery()
            ->getSingleScalarResult();
    }
}
