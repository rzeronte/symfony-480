<?php

namespace App\Backoffice\Application\Query\GetWines;

use App\Backoffice\Domain\Repository\WineRepository;

class GetWinesQueryHandler
{
    private WineRepository $wineRepository;

    public function __construct(WineRepository $wineRepository)
    {
        $this->wineRepository = $wineRepository;
    }

    public function __invoke(GetWinesQuery $query): GetWinesResponse
    {
        return GetWinesResponse::from(
            $this->wineRepository->findAll($query->getPage(), $query->getLimit()),
            $query->getPage(),
            $query->getLimit(),
            $this->wineRepository->searchCount()
        );
    }
}
