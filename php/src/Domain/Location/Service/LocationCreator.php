<?php

namespace App\Domain\Location\Service;

use App\Domain\Bing\Service\BingMapsGeocodingReader;
use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Data\LocationMysqlCreateData;
use App\Domain\Location\Repository\LocationCreatorRepository;

/**
 * Service.
 */
final class LocationCreator
{
    private $repository;
    private $bingMapsGeocodingReader;

    public function __construct(
        LocationCreatorRepository $repository,
        BingMapsGeocodingReader $bingMapsGeocodingReader
    ) {
        $this->repository = $repository;
        $this->bingMapsGeocodingReader = $bingMapsGeocodingReader;
    }

    public function createLocation(LocationCreateData $locationCreateData): string
    {
        $bingQueryAddress = $locationCreateData->name . ", " . $locationCreateData->address . ", " . $locationCreateData->city . ", " . $locationCreateData->country;
        $bingMapsGeocodingData = $this->bingMapsGeocodingReader->getBingMapsGeocodingByAddress($bingQueryAddress);

        if(!empty($bingMapsGeocodingData->lat)){
            $locationCreateData->lat = $bingMapsGeocodingData->lat;
            $locationCreateData->lon = $bingMapsGeocodingData->lon;
        }elseif(isset($locationCreateData->cityObject) && isset($locationCreateData->cityObject['latitude']) && isset($locationCreateData->cityObject['longitude'])){
            $locationCreateData->lat = $locationCreateData->cityObject['latitude'] ?? null;
            $locationCreateData->lon = $locationCreateData->cityObject['longitude'] ?? null;
        }
        $newLocationId = $this->repository->insertLocation($locationCreateData);

        $locationMysqlCreateData = new LocationMysqlCreateData();
        $locationMysqlCreateData->locationId = $newLocationId ?? null;
        $locationMysqlCreateData->name = $locationCreateData->name;
        $locationMysqlCreateData->nameBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->address = $locationCreateData->address;
        $locationMysqlCreateData->addressBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->postcode = $locationCreateData->postcode;
        $locationMysqlCreateData->postcodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->country = $locationCreateData->country;
        $locationMysqlCreateData->countryBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->countrycode = $locationCreateData->countrycode;
        $locationMysqlCreateData->countrycodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->state = $locationCreateData->state;
        $locationMysqlCreateData->stateBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->statecode = $locationCreateData->statecode;
        $locationMysqlCreateData->statecodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->city = $locationCreateData->city;
        $locationMysqlCreateData->cityBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->lat = $locationCreateData->lat;
        $locationMysqlCreateData->lon = $locationCreateData->lon;
        $locationMysqlCreateData->latlonBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->createdBy = $locationCreateData->createdBy;

        $locationMysqlCreateData->validate();

        $newLocationMysqlId = $this->repository->insertLocationMysql($locationMysqlCreateData);

        return $newLocationId;
    }
}
