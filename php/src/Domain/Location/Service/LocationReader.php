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
            $locationData->similarLocations = $this->locationsSearch->searchLocations($locationsSearchData);

            $locationNearbySearchData = new LocationNearbySearchData();
            $locationNearbySearchData->lat = $locationData->lat;
            $locationNearbySearchData->lon = $locationData->lon;

            $locationData->nearbyLocations = $this->locationNearbySearch->searchLocationNearby($locationNearbySearchData);
        } catch (\Throwable $th) {
            
        }

        return $locationData;
    }
    
    public function getLocationMysqlByLocationId(string $id): LocationMysqlData
    {

        $locationMysqlData = $this->repository->getLocationMysqlByLocationId($id);
        return $locationMysqlData;
    }
}
