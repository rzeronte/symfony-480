<?php

namespace App\Backoffice\Infrastructure\InMemory\Repository;

use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Backoffice\Domain\Repository\WineRepository;
use App\Shared\ValueObject\UUID;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InMemoryWineRepository implements WineRepository
{
    /**
     * @var Collection<string, Wine>
     */
    private Collection $wines;

    /**
     * @param array<Wine> $wines
     */
    public function __construct(array $wines = [])
    {
        $this->wines = new ArrayCollection([]);

        foreach ($wines as $wine) {
            $this->save($wine);
        }
    }

    public function getByIdOrFail(UUID $id): Wine
    {
        $sensor = $this->wines->get($id->value());

        if (!$sensor) {
            throw new BadRequestHttpException("InMemory: Wine with ID {$id->value()} not found.");
        }

        return $sensor;
    }

    public function findAll(?int $page, ?int $limit): array
    {
        $results = $this->wines;
        $criteria = Criteria::create()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
        ;

        return $results->matching($criteria)->toArray();
    }

    public function searchCount(): int
    {
        $results = $this->wines;
        $criteria = Criteria::create();

        return $results->matching($criteria)->count();
    }

    public function save(Wine $wine): void
    {
        $this->wines->set($wine->getId()->value(), $wine);
    }
}
