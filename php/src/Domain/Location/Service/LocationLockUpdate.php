<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationLockUpdateData;
use App\Domain\Location\Repository\LocationLockUpdateRepository;

/**
 * Service.
 */
final class LocationLockUpdate
{
    private $repository;

    public function __construct(LocationLockUpdateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateLocationLockByLocationIdAndField(LocationLockUpdateData $locationLockUpdateData): Bool
    {
        $locationLockUpdateArray = [];


        if (isset($locationLockUpdateData->lockOn)) {
            $locationLockUpdateArray['lockOn'] = !empty($locationLockUpdateData->lockOn) ? $locationLockUpdateData->lockOn : null;
        }

        if (isset($locationLockUpdateData->disputed)) {
            $locationLockUpdateArray['disputed'] = !empty($locationLockUpdateData->disputed) ? $locationLockUpdateData->disputed : null;
        }

        if (isset($locationLockUpdateData->updatedBy)) {
            $locationLockUpdateArray['updatedBy'] = $locationLockUpdateData->updatedBy;
        }

        if (!empty($locationLockUpdateArray)) {
            $locationLockUpdated = $this->repository->updateLocationLockByLocationIdAndField($locationLockUpdateArray, $locationLockUpdateData);
            return $locationLockUpdated;
        }

        return false;
    }
}
