<?php

namespace App\Backoffice\Application\Command\CreateMeasurement;

use Symfony\Component\Uid\Uuid;

class CreateMeasurementCommand
{
    private string $id;
    private string $sensorId;
    private string $wineId;
    private int $year;
    private string $color;
    private float $temperature;
    private float $alcoholContent;
    private float $ph;

    public function __construct(
        string $id,
        string $sensorId,
        string $wineId,
        int $year,
        string $color,
        float $temperature,
        float $alcoholContent,
        float $ph
    ) {
        $this->id = ('' === $id) ? Uuid::v4() : $id;
        $this->sensorId = $sensorId;
        $this->wineId = $wineId;
        $this->year = $year;
        $this->color = $color;
        $this->temperature = $temperature;
        $this->alcoholContent = $alcoholContent;
        $this->ph = $ph;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSensorId(): string
    {
        return $this->sensorId;
    }

    public function getWineId(): string
    {
        return $this->wineId;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getAlcoholContent(): float
    {
        return $this->alcoholContent;
    }

    public function getPh(): float
    {
        return $this->ph;
    }
}
