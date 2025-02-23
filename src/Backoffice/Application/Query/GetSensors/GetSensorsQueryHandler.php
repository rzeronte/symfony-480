<?php

namespace App\Backoffice\Application\Query\GetSensors;

use App\Backoffice\Domain\Repository\SensorRepository;

class GetSensorsQueryHandler
{
    private SensorRepository $sensorRepository;

    public function __construct(SensorRepository $sensorRepository)
    {
        $this->sensorRepository = $sensorRepository;
    }

    public function __invoke(GetSensorsQuery $query): GetSensorsResponse
    {
        return GetSensorsResponse::from(
            $this->sensorRepository->findAll($query->getPage(), $query->getLimit()),
            $query->getPage(),
            $query->getLimit(),
            $this->sensorRepository->searchCount()
        );
    }
}
