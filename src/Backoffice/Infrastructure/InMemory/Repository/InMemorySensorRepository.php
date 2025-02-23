<?php

namespace App\Backoffice\Infrastructure\InMemory\Repository;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Repository\SensorRepository;
use App\Shared\ValueObject\UUID;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InMemorySensorRepository implements SensorRepository
{
    /**
     * @var Collection<string, Sensor>
     */
    private Collection $sensors;

    /**
     * @param array<Sensor> $products
     */
    public function __construct(array $products = [])
    {
        $this->sensors = new ArrayCollection([]);

        foreach ($products as $product) {
            $this->save($product);
        }
    }

    public function getByIdOrFail(UUID $from): Sensor
    {
        $sensor = $this->sensors->get($from->value());

        if (!$sensor) {
            throw new NotFoundHttpException();
        }

        return $sensor;
    }

    public function searchCount(): int
    {
        $results = $this->sensors;
        $criteria = Criteria::create();

        return $results->matching($criteria)->count();
    }

    public function findAll(?int $page, ?int $limit): array
    {
        $results = $this->sensors;
        $criteria = Criteria::create()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
        ;

        return $results->matching($criteria)->toArray();
    }

    public function save(Sensor $sensor): void
    {
        $this->sensors->set($sensor->getId()->value(), $sensor);
    }
}
