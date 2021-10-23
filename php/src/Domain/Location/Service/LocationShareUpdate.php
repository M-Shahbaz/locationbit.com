<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationShareUpdateData;
use App\Domain\Location\Repository\LocationShareUpdateRepository;

/**
 * Service.
 */
final class LocationShareUpdate
{
    private $repository;

    public function __construct(LocationShareUpdateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateLocationShare(LocationShareUpdateData $locationShareUpdateData): Bool
    {
        $locationShareUpdateArray = [];
        
        if (isset($locationShareUpdateData->name)) {
            $locationShareUpdateArray['name'] = !empty($locationShareUpdateData->name) ? $locationShareUpdateData->name : null;
        }

        if (isset($locationShareUpdateData->description)) {
            $locationShareUpdateArray['description'] = !empty($locationShareUpdateData->description) ? $locationShareUpdateData->description : null;
        }

        if (isset($locationShareUpdateData->address)) {
            $locationShareUpdateArray['address'] = !empty($locationShareUpdateData->address) ? $locationShareUpdateData->address : null;
        }

        if (isset($locationShareUpdateData->city)) {
            $locationShareUpdateArray['city'] = !empty($locationShareUpdateData->city) ? $locationShareUpdateData->city : null;
        }

        if (isset($locationShareUpdateData->state)) {
            $locationShareUpdateArray['state'] = !empty($locationShareUpdateData->state) ? $locationShareUpdateData->state : null;
        }

        if (isset($locationShareUpdateData->country)) {
            $locationShareUpdateArray['country'] = !empty($locationShareUpdateData->country) ? $locationShareUpdateData->country : null;
        }

        if (isset($locationShareUpdateData->postcode)) {
            $locationShareUpdateArray['postcode'] = !empty($locationShareUpdateData->postcode) ? $locationShareUpdateData->postcode : null;
        }

        if (isset($locationShareUpdateData->latlon)) {
            $locationShareUpdateArray['latlon'] = !empty($locationShareUpdateData->latlon) ? $locationShareUpdateData->latlon : null;
        }

        if (isset($locationShareUpdateData->website)) {
            $locationShareUpdateArray['website'] = !empty($locationShareUpdateData->website) ? $locationShareUpdateData->website : null;
        }

        if (isset($locationShareUpdateData->email)) {
            $locationShareUpdateArray['email'] = !empty($locationShareUpdateData->email) ? $locationShareUpdateData->email : null;
        }

        if (isset($locationShareUpdateData->phone)) {
            $locationShareUpdateArray['phone'] = !empty($locationShareUpdateData->phone) ? $locationShareUpdateData->phone : null;
        }

        if (isset($locationShareUpdateData->googleMaps)) {
            $locationShareUpdateArray['googleMaps'] = !empty($locationShareUpdateData->googleMaps) ? $locationShareUpdateData->googleMaps : null;
        }

        if (isset($locationShareUpdateData->googleStreetView)) {
            $locationShareUpdateArray['googleStreetView'] = !empty($locationShareUpdateData->googleStreetView) ? $locationShareUpdateData->googleStreetView : null;
        }

        if (isset($locationShareUpdateData->facebook)) {
            $locationShareUpdateArray['facebook'] = !empty($locationShareUpdateData->facebook) ? $locationShareUpdateData->facebook : null;
        }

        if (isset($locationShareUpdateData->twitter)) {
            $locationShareUpdateArray['twitter'] = !empty($locationShareUpdateData->twitter) ? $locationShareUpdateData->twitter : null;
        }

        if (isset($locationShareUpdateData->instagram)) {
            $locationShareUpdateArray['instagram'] = !empty($locationShareUpdateData->instagram) ? $locationShareUpdateData->instagram : null;
        }

        if (isset($locationShareUpdateData->youtube)) {
            $locationShareUpdateArray['youtube'] = !empty($locationShareUpdateData->youtube) ? $locationShareUpdateData->youtube : null;
        }

        if (isset($locationShareUpdateData->linkedin)) {
            $locationShareUpdateArray['linkedin'] = !empty($locationShareUpdateData->linkedin) ? $locationShareUpdateData->linkedin : null;
        }

        if (isset($locationShareUpdateData->telegram)) {
            $locationShareUpdateArray['telegram'] = !empty($locationShareUpdateData->telegram) ? $locationShareUpdateData->telegram : null;
        }

        if (isset($locationShareUpdateData->sector)) {
            $locationShareUpdateArray['sector'] = !empty($locationShareUpdateData->sector) ? $locationShareUpdateData->sector : null;
        }

        if (isset($locationShareUpdateData->subSector)) {
            $locationShareUpdateArray['subSector'] = !empty($locationShareUpdateData->subSector) ? $locationShareUpdateData->subSector : null;
        }

        if (isset($locationShareUpdateData->industryGroup)) {
            $locationShareUpdateArray['industryGroup'] = !empty($locationShareUpdateData->industryGroup) ? $locationShareUpdateData->industryGroup : null;
        }

        if (isset($locationShareUpdateData->naicsIndustry)) {
            $locationShareUpdateArray['naicsIndustry'] = !empty($locationShareUpdateData->naicsIndustry) ? $locationShareUpdateData->naicsIndustry : null;
        }

        if (isset($locationShareUpdateData->nationalIndustry)) {
            $locationShareUpdateArray['nationalIndustry'] = !empty($locationShareUpdateData->nationalIndustry) ? $locationShareUpdateData->nationalIndustry : null;
        }

        if (isset($locationShareUpdateData->hoursMondayFrom)) {
            $locationShareUpdateArray['hoursMondayFrom'] = !empty($locationShareUpdateData->hoursMondayFrom) ? $locationShareUpdateData->hoursMondayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursMondayTo)) {
            $locationShareUpdateArray['hoursMondayTo'] = !empty($locationShareUpdateData->hoursMondayTo) ? $locationShareUpdateData->hoursMondayTo : null;
        }

        if (isset($locationShareUpdateData->hoursTuesdayFrom)) {
            $locationShareUpdateArray['hoursTuesdayFrom'] = !empty($locationShareUpdateData->hoursTuesdayFrom) ? $locationShareUpdateData->hoursTuesdayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursTuesdayTo)) {
            $locationShareUpdateArray['hoursTuesdayTo'] = !empty($locationShareUpdateData->hoursTuesdayTo) ? $locationShareUpdateData->hoursTuesdayTo : null;
        }

        if (isset($locationShareUpdateData->hoursWednesdayFrom)) {
            $locationShareUpdateArray['hoursWednesdayFrom'] = !empty($locationShareUpdateData->hoursWednesdayFrom) ? $locationShareUpdateData->hoursWednesdayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursWednesdayTo)) {
            $locationShareUpdateArray['hoursWednesdayTo'] = !empty($locationShareUpdateData->hoursWednesdayTo) ? $locationShareUpdateData->hoursWednesdayTo : null;
        }

        if (isset($locationShareUpdateData->hoursThursdayFrom)) {
            $locationShareUpdateArray['hoursThursdayFrom'] = !empty($locationShareUpdateData->hoursThursdayFrom) ? $locationShareUpdateData->hoursThursdayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursThursdayTo)) {
            $locationShareUpdateArray['hoursThursdayTo'] = !empty($locationShareUpdateData->hoursThursdayTo) ? $locationShareUpdateData->hoursThursdayTo : null;
        }

        if (isset($locationShareUpdateData->hoursFridayFrom)) {
            $locationShareUpdateArray['hoursFridayFrom'] = !empty($locationShareUpdateData->hoursFridayFrom) ? $locationShareUpdateData->hoursFridayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursFridayTo)) {
            $locationShareUpdateArray['hoursFridayTo'] = !empty($locationShareUpdateData->hoursFridayTo) ? $locationShareUpdateData->hoursFridayTo : null;
        }

        if (isset($locationShareUpdateData->hoursSaturdayFrom)) {
            $locationShareUpdateArray['hoursSaturdayFrom'] = !empty($locationShareUpdateData->hoursSaturdayFrom) ? $locationShareUpdateData->hoursSaturdayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursSaturdayTo)) {
            $locationShareUpdateArray['hoursSaturdayTo'] = !empty($locationShareUpdateData->hoursSaturdayTo) ? $locationShareUpdateData->hoursSaturdayTo : null;
        }

        if (isset($locationShareUpdateData->hoursSundayFrom)) {
            $locationShareUpdateArray['hoursSundayFrom'] = !empty($locationShareUpdateData->hoursSundayFrom) ? $locationShareUpdateData->hoursSundayFrom : null;
        }

        if (isset($locationShareUpdateData->hoursSundayTo)) {
            $locationShareUpdateArray['hoursSundayTo'] = !empty($locationShareUpdateData->hoursSundayTo) ? $locationShareUpdateData->hoursSundayTo : null;
        }

        if (isset($locationShareUpdateData->updatedBy)) {
            $locationShareUpdateArray['updatedBy'] = $locationShareUpdateData->updatedBy;
        }

        if (!empty($locationShareUpdateArray)) {
            $locationShareUpdated = $this->repository->updateLocationShare($locationShareUpdateArray, $locationShareUpdateData);
            return $locationShareUpdated;
        }

        return false;
    }
}
