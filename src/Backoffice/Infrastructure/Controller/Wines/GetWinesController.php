<?php

namespace App\Backoffice\Infrastructure\Controller\Wines;

use App\Backoffice\Application\Query\GetWines\GetWinesQuery;
use App\Shared\Infrastructure\Rest\ApiQueryPage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetWinesController extends ApiQueryPage
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->ask(
            new GetWinesQuery(
                $request->get('page'),
                $request->get('limit'),
            )
        );

        return new JsonResponse($result, Response::HTTP_OK);
    }
}
