<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationData;
use App\Domain\Location\Data\LocationMysqlData;
use App\Domain\Location\Data\LocationNearbySearchData;
use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Repository\LocationReaderRepository;
use App\Utility\LocationsService;

/**
 * Service.
 */
final class LocationReader
{
    private $repository;
    private $locationNearbySearch;
    private $locationsSearch;

    public function __construct(
        LocationReaderRepository $repository,
        LocationNearbySearch $locationNearbySearch,
        LocationsSearch $locationsSearch
    ) {
        $this->repository = $repository;
        $this->locationNearbySearch = $locationNearbySearch;
        $this->locationsSearch = $locationsSearch;
    }

    public function getLocationById(string $id): LocationData
    {

        $locationData = $this->repository->getLocationById($id);
        return $locationData;
    }

    public function getLocationByIdWithSimilarAndNearByLocations(string $id): LocationData
    {

        $locationData = $this->getLocationById($id);

        try {

            $locationsSearchData = new LocationsSearchData();
            $locationsSearchData->q = $locationData->name . ", " . $locationData->address . ", " . $locationData->city . ", " . $locationData->state . ", " . $locationData->country;
            $similarLocations = $this->locationsSearch->searchLocations($locationsSearchData);

            foreach ((array)$similarLocations['results'] as $key => $row) {
                if ($locationData->id == $row->id) {
                    unset($similarLocations['results'][$key]);
                }
            }

            if (isset($similarLocations['results'])) {
                sort($similarLocations['results']);
            }

            $locationData->similarLocations = $similarLocations;

            $locationNearbySearchData = new LocationNearbySearchData();
            $locationNearbySearchData->lat = $locationData->lat;
            $locationNearbySearchData->lon = $locationData->lon;

            $nearbyLocations = $this->locationNearbySearch->searchLocationNearby($locationNearbySearchData);


            foreach ((array)$nearbyLocations['results'] as $key => $row) {
                if ($locationData->id == $row->id) {
                    unset($nearbyLocations['results'][$key]);
                }
            }
            
            if (isset($nearbyLocations['results'])) {
                sort($nearbyLocations['results']);
            }

            $locationData->nearbyLocations = $nearbyLocations;
        } catch (\Throwable $th) {
        }

        return $locationData;
    }

    public function getLocationMysqlByLocationId(string $id): LocationMysqlData
    {

        $locationMysqlData = $this->repository->getLocationMysqlByLocationId($id);
        $locationMysqlData->hoursMondayFrom = !empty($locationMysqlData->hoursMondayFrom) ? substr($locationMysqlData->hoursMondayFrom, 0, -3) : null;
        $locationMysqlData->hoursMondayTo = !empty($locationMysqlData->hoursMondayTo) ? substr($locationMysqlData->hoursMondayTo, 0, -3) : null;
        $locationMysqlData->hoursTuesdayFrom = !empty($locationMysqlData->hoursTuesdayFrom) ? substr($locationMysqlData->hoursTuesdayFrom, 0, -3) : null;
        $locationMysqlData->hoursTuesdayTo = !empty($locationMysqlData->hoursTuesdayTo) ? substr($locationMysqlData->hoursTuesdayTo, 0, -3) : null;
        $locationMysqlData->hoursWednesdayFrom = !empty($locationMysqlData->hoursWednesdayFrom) ? substr($locationMysqlData->hoursWednesdayFrom, 0, -3) : null;
        $locationMysqlData->hoursWednesdayTo = !empty($locationMysqlData->hoursWednesdayTo) ? substr($locationMysqlData->hoursWednesdayTo, 0, -3) : null;
        $locationMysqlData->hoursThursdayFrom = !empty($locationMysqlData->hoursThursdayFrom) ? substr($locationMysqlData->hoursThursdayFrom, 0, -3) : null;
        $locationMysqlData->hoursThursdayTo = !empty($locationMysqlData->hoursThursdayTo) ? substr($locationMysqlData->hoursThursdayTo, 0, -3) : null;
        $locationMysqlData->hoursFridayFrom = !empty($locationMysqlData->hoursFridayFrom) ? substr($locationMysqlData->hoursFridayFrom, 0, -3) : null;
        $locationMysqlData->hoursFridayTo = !empty($locationMysqlData->hoursFridayTo) ? substr($locationMysqlData->hoursFridayTo, 0, -3) : null;
        $locationMysqlData->hoursSaturdayFrom = !empty($locationMysqlData->hoursSaturdayFrom) ? substr($locationMysqlData->hoursSaturdayFrom, 0, -3) : null;
        $locationMysqlData->hoursSaturdayTo = !empty($locationMysqlData->hoursSaturdayTo) ? substr($locationMysqlData->hoursSaturdayTo, 0, -3) : null;

        return $locationMysqlData;
    }
}
