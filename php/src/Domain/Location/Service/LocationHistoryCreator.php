<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationHistoryCreateData;
use App\Domain\Location\Repository\LocationHistoryCreatorRepository;

/**
 * Service.
 */
final class LocationHistoryCreator
{
    private $repository;

    public function __construct(LocationHistoryCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLocationHistory(LocationHistoryCreateData $locationHistoryCreateData): Int
    {
        $newLocationHistoryId = $this->repository->insertLocationHistory($locationHistoryCreateData);
        return $newLocationHistoryId;
    }
}