<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationLockCreateData;
use App\Domain\Location\Repository\LocationLockCreatorRepository;

/**
 * Service.
 */
final class LocationLockCreator
{
    private $repository;

    public function __construct(LocationLockCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLocationLock(LocationLockCreateData $locationLockCreateData): Int
    {
        $newLocationLockId = $this->repository->insertLocationLock($locationLockCreateData);
        return $newLocationLockId;
    }
}