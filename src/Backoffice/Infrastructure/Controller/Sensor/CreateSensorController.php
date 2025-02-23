<?php

namespace App\Backoffice\Infrastructure\Controller\Sensor;

use App\Backoffice\Application\Command\CreateSensor\CreateSensorCommand;
use App\Shared\Infrastructure\Rest\ApiCommandPage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class CreateSensorController extends ApiCommandPage
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), false);

        $id = $payload->id ?? Uuid::v4();

        $this->dispatch(
            new CreateSensorCommand(
                $id,
                $payload->name ?? '',
            )
        );

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
