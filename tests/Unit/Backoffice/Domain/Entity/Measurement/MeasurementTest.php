<?php

namespace App\Tests\Unit\Backoffice\Domain\Entity\Measurement;

use App\Backoffice\Domain\Entity\Measurement\Measurement;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementAlcoholContent;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementColor;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementId;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementPh;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementTemperature;
use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Backoffice\Domain\Entity\Wine\ValueObject\WineId;
use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\YearNotNullable;
use Assert\AssertionFailedException;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{
    /**
     * @throws AssertionFailedException
     */
    public function testMeasurementEntityConstraints(): void
    {
        $measurement = Measurement::from(
            MeasurementId::from('00000000-0000-0000-0000-000000000000'),
            YearNotNullable::from(2025),
            Wine::from(
                WineId::from('00000000-0000-0000-0000-000000000000'),
                YearNotNullable::from(2024),
                StringNotBlank::from('wine1'),
                new ArrayCollection()
            ),
            Sensor::from(
                SensorId::from('00000000-0000-0000-0000-000000000000'),
                StringNotBlank::from('sensor1'),
            ),
            MeasurementColor::from('#112233'),
            MeasurementTemperature::from(0),
            MeasurementAlcoholContent::from(0),
            MeasurementPh::from(0),
        );

        $this->assertEquals('00000000-0000-0000-0000-000000000000', $measurement->getId()->value());
        $this->assertEquals(2025, $measurement->getYear()->value());
        $this->assertEquals('#112233', $measurement->getColor()->value());
        $this->assertEquals(0, $measurement->getTemperature()->value());
        $this->assertEquals(0, $measurement->getAlcoholContent()->value());
        $this->assertEquals(0, $measurement->getPh()->value());

        $this->assertEquals('00000000-0000-0000-0000-000000000000', $measurement->getWine()->getId()->value());
        $this->assertEquals('wine1', $measurement->getWine()->getName()->value());
        $this->assertEquals(2024, $measurement->getWine()->getYear()->value());
        $this->assertEquals(new ArrayCollection([]), $measurement->getWine()->getMeasurements());

        $this->assertEquals('00000000-0000-0000-0000-000000000000', $measurement->getSensor()->getId()->value());
        $this->assertEquals('sensor1', $measurement->getSensor()->getName()->value());
    }

    protected function setUp(): void
    {
    }
}
