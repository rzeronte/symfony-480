<?php

namespace App\DataFixtures;

use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Shared\ValueObject\StringNotBlank;
use Assert\AssertionFailedException;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SensorFixtures extends Fixture
{
    public static array $sensors = [
        ['id' => '9b0e8fe6-a4dd-41f7-8400-cc23f54c7478', 'name' => 'Sensor Gijón', 'year' => 2015],
        ['id' => '3aeea1d3-6543-4c29-bb81-bde3c6c8c2a1', 'name' => 'Sensor Madrid', 'year' => 2014],
        ['id' => '647bdce2-c65f-496f-8817-e8cde89308ac', 'name' => 'Sensor Barcelona', 'year' => 2015],
    ];

    /**
     * @throws AssertionFailedException
     */
    public function load(ObjectManager $manager): void
    {
        foreach (SensorFixtures::$sensors as $sensor) {
            $manager->persist(Sensor::from(
                SensorId::from($sensor['id']),
                StringNotBlank::from($sensor['name']),
            ));
        }

        $manager->flush();
    }
}
