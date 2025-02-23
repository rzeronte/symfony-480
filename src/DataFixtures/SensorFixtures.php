<?php

namespace App\DataFixtures;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\UUID;
use Assert\AssertionFailedException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SensorFixtures extends Fixture
{
    /**
     * @throws AssertionFailedException
     */
    public function load(ObjectManager $manager): void
    {
        $manager->persist(Sensor::from(
            UUID::from('f2b4b93c-1cee-4523-adfd-67c9b7824058'),
            StringNotBlank::from('Sensor Gijón'),
        ));

        $manager->flush();
    }
}
