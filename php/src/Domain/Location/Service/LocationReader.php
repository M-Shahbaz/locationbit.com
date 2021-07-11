<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationData;
use App\Domain\Location\Repository\LocationReaderRepository;

/**
 * Service.
 */
final class LocationReader
{
    private $repository;

    public function __construct(LocationReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLocationById(string $id): LocationData
    {
        
        $locationData = $this->repository->getLocationById($id);
        return $locationData;
    }
}