<?php

namespace App\Backoffice\Application\Command\CreateMeasurement;

use App\Backoffice\Domain\Entity\Measurement\Measurement;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementAlcoholContent;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementColor;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementPh;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementTemperature;
use App\Backoffice\Domain\Repository\MeasurementRepository;
use App\Backoffice\Domain\Repository\SensorRepository;
use App\Backoffice\Domain\Repository\WineRepository;
use App\Shared\ValueObject\UUID;
use App\Shared\ValueObject\YearNotNullable;
use Assert\AssertionFailedException;

class CreateMeasurementCommandHandler
{
    private MeasurementRepository $measurementRepository;
    private WineRepository $wineRepository;
    private SensorRepository $sensorRepository;

    public function __construct(
        MeasurementRepository $measurementRepository,
        WineRepository $wineRepository,
        SensorRepository $sensorRepository
    ) {
        $this->measurementRepository = $measurementRepository;
        $this->wineRepository = $wineRepository;
        $this->sensorRepository = $sensorRepository;
    }

    /**
     * @throws AssertionFailedException
     */
    public function __invoke(CreateMeasurementCommand $command): void
    {
        $measurement = Measurement::from(
            UUID::from($command->getId()),
            YearNotNullable::from($command->getYear()),
            $this->wineRepository->getByIdOrFail(UUID::from($command->getWineId())),
            $this->sensorRepository->getByIdOrFail(UUID::from($command->getSensorId())),
            MeasurementColor::from($command->getColor()),
            MeasurementTemperature::from($command->getTemperature()),
            MeasurementAlcoholContent::from($command->getAlcoholContent()),
            MeasurementPh::from($command->getPh()),
        );

        $this->measurementRepository->save($measurement);
    }
}
