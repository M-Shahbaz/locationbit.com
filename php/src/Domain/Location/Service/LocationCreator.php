<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Repository\LocationCreatorRepository;

/**
 * Service.
 */
final class LocationCreator
{
    private $repository;

    public function __construct(LocationCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLocation(LocationCreateData $locationCreateData): Int
    {
        $newLocationId = $this->repository->insertLocation($locationCreateData);
        return $newLocationId;
    }
}