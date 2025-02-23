<?php

namespace App\DataFixtures;

use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\UUID;
use App\Shared\ValueObject\YearNotNullable;
use Assert\AssertionFailedException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class WineFixtures extends Fixture
{
    /**
     * @throws AssertionFailedException
     */
    public function load(ObjectManager $manager): void
    {
        $wines = [
            ['id' => 'a461d3c1-fb43-4d76-ba30-617af7021764', 'name' => 'Cabernet Sauvignon', 'year' => 2015],
            ['id' => '03bb08db-e4b1-4f9a-9771-a1a6f6479125', 'name' => 'Merlot', 'year' => 2018],
            ['id' => '89f3df37-6030-4434-b7c9-c9f5e9c98023', 'name' => 'Pinot Noir', 'year' => 2020],
            ['id' => '7f268efd-bbc7-46e0-b390-cd7c1f06c150', 'name' => 'Chardonnay', 'year' => 2017],
            ['id' => '5777dd2e-3c6e-42ac-a95b-76c18b1725ff', 'name' => 'Sauvignon Blanc', 'year' => 2019],
        ];

        foreach ($wines as $wineData) {
            $manager->persist(Wine::from(
                UUID::from($wineData['id']),
                YearNotNullable::from($wineData['year']),
                StringNotBlank::from($wineData['name']),
                new ArrayCollection()
            ));
        }

        $manager->flush();
    }
}
