<?php

namespace App\Backoffice\Domain\Entity\Measurement;

use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementAlcoholContent;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementColor;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementPh;
use App\Backoffice\Domain\Entity\Measurement\ValueObject\MeasurementTemperature;
use App\Backoffice\Domain\Entity\Sensor\Sensor;
use App\Backoffice\Domain\Entity\Wine\Wine;
use App\Shared\ValueObject\UUID;
use App\Shared\ValueObject\YearNotNullable;

class Measurement implements \JsonSerializable
{
    private UUID $id;
    private Wine $wine;
    private Sensor $sensor;
    private YearNotNullable $year;
    private MeasurementColor $color;
    private MeasurementTemperature $temperature;
    private MeasurementAlcoholContent $alcoholContent;
    private MeasurementPh $ph;

    private function __construct(
        UUID $id,
        YearNotNullable $year,
        Wine $wine,
        Sensor $sensor,
        MeasurementColor $color,
        MeasurementTemperature $temperature,
        MeasurementAlcoholContent $alcoholContent,
        MeasurementPh $ph
    ) {
        $this->id = $id;
        $this->year = $year;
        $this->wine = $wine;
        $this->sensor = $sensor;
        $this->color = $color;
        $this->temperature = $temperature;
        $this->alcoholContent = $alcoholContent;
        $this->ph = $ph;
    }

    public static function from(
        UUID $id,
        YearNotNullable $year,
        Wine $wine,
        Sensor $sensor,
        MeasurementColor $color,
        MeasurementTemperature $temperature,
        MeasurementAlcoholContent $graduation,
        MeasurementPh $ph
    ): Measurement {
        return new self($id, $year, $wine, $sensor, $color, $temperature, $graduation, $ph);
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getYear(): YearNotNullable
    {
        return $this->year;
    }

    public function getWine(): Wine
    {
        return $this->wine;
    }

    public function getSensor(): Sensor
    {
        return $this->sensor;
    }

    public function getColor(): MeasurementColor
    {
        return $this->color;
    }

    public function getTemperature(): MeasurementTemperature
    {
        return $this->temperature;
    }

    public function getPh(): MeasurementPh
    {
        return $this->ph;
    }

    public function getAlcoholContent(): MeasurementAlcoholContent
    {
        return $this->alcoholContent;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value(),
            'year' => $this->year->value(),
            'color' => $this->color->value(),
            'alcoholContent' => $this->alcoholContent->value(),
            'temperature' => $this->temperature->value(),
            'ph' => $this->ph->value(),
            'sensor' => $this->sensor,
        ];
    }
}
