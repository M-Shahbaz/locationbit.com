<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationLockData;
use App\Domain\Location\Repository\LocationLockReaderRepository;

/**
 * Service.
 */
final class LocationLockReader
{
    private $repository;

    public function __construct(LocationLockReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLocationLockByLocationIdAndField(string $locationId, string $field): LocationLockData
    {
        
        $locationLockData = $this->repository->getLocationLockByLocationIdAndField($locationId, $field);
        return $locationLockData;
    }
}