<?php

namespace App\Backoffice\Infrastructure\Controller\Sensor;

use App\Backoffice\Application\Query\GetSensors\GetSensorsQuery;
use App\Shared\Infrastructure\Rest\ApiQueryPage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetSensorsController extends ApiQueryPage
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->ask(
            new GetSensorsQuery(
                $request->get('page'),
                $request->get('limit'),
            )
        );

        return new JsonResponse($result, Response::HTTP_OK);
    }
}
