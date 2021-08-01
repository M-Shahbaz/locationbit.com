<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationUpdateData;
use App\Domain\Location\Repository\LocationUpdateRepository;

/**
 * Service.
 */
final class LocationUpdate
{
    private $repository;

    public function __construct(LocationUpdateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateLocation(LocationUpdateData $locationUpdateData): ?string
    {
        $locationUpdateArray = [];


        if (isset($locationUpdateData->postcode)) {
            $locationUpdateArray['postcode'] = !empty($locationUpdateData->postcode) ? $locationUpdateData->postcode : null;
        }

        if(isset($locationUpdateData->lat)){
            $locationUpdateArray['coordinate']['lat'] = !empty($locationUpdateData->lat) ? $locationUpdateData->lat : null;
        }
        
        if(isset($locationUpdateData->lon)){
            $locationUpdateArray['coordinate']['lon'] = !empty($locationUpdateData->lon) ? $locationUpdateData->lon : null;
        }

        if (isset($locationUpdateData->website)) {
            $locationUpdateArray['website'] = !empty($locationUpdateData->website) ? $locationUpdateData->website : null;
        }

        if (isset($locationUpdateData->email)) {
            $locationUpdateArray['email'] = !empty($locationUpdateData->email) ? $locationUpdateData->email : null;
        }

        if (isset($locationUpdateData->phone)) {
            $locationUpdateArray['phone'] = !empty($locationUpdateData->phone) ? $locationUpdateData->phone : null;
        }

        if (isset($locationUpdateData->description)) {
            $locationUpdateArray['description'] = !empty($locationUpdateData->description) ? $locationUpdateData->description : null;
        }

        if (!empty($locationUpdateArray)) {
            $locationUpdated = $this->repository->updateLocation($locationUpdateArray, $locationUpdateData);
            return $locationUpdated;
        }

        return null;
    }
}
