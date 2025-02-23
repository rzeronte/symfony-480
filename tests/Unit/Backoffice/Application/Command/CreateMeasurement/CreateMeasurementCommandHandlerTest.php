<?php

namespace App\Tests\Unit\Backoffice\Application\Command\CreateMeasurement;

use App\Backoffice\Application\Command\CreateMeasurement\CreateMeasurementCommand;
use App\Backoffice\Application\Command\CreateMeasurement\CreateMeasurementCommandHandler;
use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Entity\Sensor\ValueObject\SensorId;
use App\Backoffice\Domain\Entity\Wine\ValueObject\WineId;
use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemoryMeasurementRepository;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemorySensorRepository;
use App\Backoffice\Infrastructure\InMemory\Repository\InMemoryWineRepository;
use App\Shared\ValueObject\StringNotBlank;
use App\Shared\ValueObject\YearNotNullable;
use Assert\AssertionFailedException;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CreateMeasurementCommandHandlerTest extends TestCase
{
    private InMemoryMeasurementRepository $measurementRepository;
    private InMemoryWineRepository $wineRepository;
    private InMemorySensorRepository $sensorRepository;

    /**
     * @throws AssertionFailedException
     */
    public function testCreateMeasurementWithGoodArgumentsMustCreateOneSensor(): void
    {
        $measurementsCountInitial = $this->measurementRepository->count();

        $command = new CreateMeasurementCommand(
            Uuid::v4(),
            'bdad5364-d60b-4bad-b8b7-c56bc5b285e6',
            'de747bab-43a1-464f-9a5e-2fa3a9b6a450',
            2025,
            '#112233',
            10.1,
            1.1,
            1
        );

        (new CreateMeasurementCommandHandler(
            $this->measurementRepository,
            $this->wineRepository,
            $this->sensorRepository
        ))($command);

        $this->assertEquals($measurementsCountInitial + 1, $this->measurementRepository->count());
    }

    /**
     * @throws AssertionFailedException
     */
    protected function setUp(): void
    {
        $this->measurementRepository = new InMemoryMeasurementRepository();
        $this->wineRepository = new InMemoryWineRepository();
        $this->sensorRepository = new InMemorySensorRepository();

        $this->sensorRepository->save(
            Sensor::from(
                SensorId::from('bdad5364-d60b-4bad-b8b7-c56bc5b285e6'),
                StringNotBlank::from('sensor1'),
            )
        );

        $this->wineRepository->save(
            Wine::from(
                WineId::from('de747bab-43a1-464f-9a5e-2fa3a9b6a450'),
                YearNotNullable::from(2024),
                StringNotBlank::from('wine1'),
                new ArrayCollection()
            ),
        );
    }
}
