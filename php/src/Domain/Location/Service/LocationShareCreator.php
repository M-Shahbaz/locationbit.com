<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationShareCreateData;
use App\Domain\Location\Repository\LocationShareCreatorRepository;

/**
 * Service.
 */
final class LocationShareCreator
{
    private $repository;

    public function __construct(LocationShareCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLocationShare(LocationShareCreateData $locationShareCreateData): Int
    {
        $newLocationShareId = $this->repository->insertLocationShare($locationShareCreateData);
        return $newLocationShareId;
    }
}