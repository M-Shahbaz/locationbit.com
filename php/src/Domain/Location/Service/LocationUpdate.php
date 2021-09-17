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

        if (isset($locationUpdateData->googleMaps)) {
            $locationUpdateArray['googleMaps'] = !empty($locationUpdateData->googleMaps) ? $locationUpdateData->googleMaps : null;
        }

        if (isset($locationUpdateData->googleStreetView)) {
            $locationUpdateArray['googleStreetView'] = !empty($locationUpdateData->googleStreetView) ? $locationUpdateData->googleStreetView : null;
        }

        if (isset($locationUpdateData->facebook)) {
            $locationUpdateArray['facebook'] = !empty($locationUpdateData->facebook) ? $locationUpdateData->facebook : null;
        }

        if (isset($locationUpdateData->twitter)) {
            $locationUpdateArray['twitter'] = !empty($locationUpdateData->twitter) ? $locationUpdateData->twitter : null;
        }

        if (isset($locationUpdateData->instagram)) {
            $locationUpdateArray['instagram'] = !empty($locationUpdateData->instagram) ? $locationUpdateData->instagram : null;
        }

        if (isset($locationUpdateData->youtube)) {
            $locationUpdateArray['youtube'] = !empty($locationUpdateData->youtube) ? $locationUpdateData->youtube : null;
        }

        if (isset($locationUpdateData->linkedin)) {
            $locationUpdateArray['linkedin'] = !empty($locationUpdateData->linkedin) ? $locationUpdateData->linkedin : null;
        }

        if (isset($locationUpdateData->telegram)) {
            $locationUpdateArray['telegram'] = !empty($locationUpdateData->telegram) ? $locationUpdateData->telegram : null;
        }

        if (isset($locationUpdateData->description)) {
            $locationUpdateArray['description'] = !empty($locationUpdateData->description) ? $locationUpdateData->description : null;
        }

        if (isset($locationUpdateData->sector)) {
            $locationUpdateArray['sector'] = !empty($locationUpdateData->sector) ? (int)$locationUpdateData->sector : null;
        }

        if (isset($locationUpdateData->subSector)) {
            $locationUpdateArray['subSector'] = !empty($locationUpdateData->subSector) ? (int)$locationUpdateData->subSector : null;
        }

        if (isset($locationUpdateData->industryGroup)) {
            $locationUpdateArray['industryGroup'] = !empty($locationUpdateData->industryGroup) ? (int)$locationUpdateData->industryGroup : null;
        }

        if (isset($locationUpdateData->naicsIndustry)) {
            $locationUpdateArray['naicsIndustry'] = !empty($locationUpdateData->naicsIndustry) ? (int)$locationUpdateData->naicsIndustry : null;
        }

        if (isset($locationUpdateData->nationalIndustry)) {
            $locationUpdateArray['nationalIndustry'] = !empty($locationUpdateData->nationalIndustry) ? (int)$locationUpdateData->nationalIndustry : null;
        }

        if (isset($locationUpdateData->hours)) {
            $locationUpdateArray['hours'] = !empty($locationUpdateData->hours) ? (array)$locationUpdateData->hours : null;
        }

        if (!empty($locationUpdateArray)) {
            $locationUpdated = $this->repository->updateLocation($locationUpdateArray, $locationUpdateData);
            return $locationUpdated;
        }

        return null;
    }
}
