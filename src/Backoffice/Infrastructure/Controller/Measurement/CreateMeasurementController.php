<?php

namespace App\Backoffice\Infrastructure\Controller\Measurement;

use App\Backoffice\Application\Command\CreateMeasurement\CreateMeasurementCommand;
use App\Shared\Infrastructure\Rest\ApiCommandPage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class CreateMeasurementController extends ApiCommandPage
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), false);

        $id = $payload->id ?? Uuid::v4();

        $this->dispatch(
            new CreateMeasurementCommand(
                $id,
                $payload->sensor_id ?? '',
                $payload->wine_id ?? '',
                $payload->year ?? 0,
                $payload->color ?? '',
                $payload->temperature ?? 0.0,
                $payload->alcohol_content ?? 0.0,
                $payload->ph ?? 0.0,
            )
        );

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
