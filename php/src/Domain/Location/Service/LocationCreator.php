<?php

namespace App\Domain\Location\Service;

use App\Domain\Bing\Service\BingMapsGeocodingReader;
use App\Domain\Location\Data\LocationCreateData;
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

    public function createLocation(LocationCreateData $locationCreateData): Int
    {
        $bingQueryAddress = $locationCreateData->name . ", " . $locationCreateData->address . ", " . $locationCreateData->city . ", " . $locationCreateData->country;
        $bingMapsGeocodingData = $this->bingMapsGeocodingReader->getBingMapsGeocodingByAddress($bingQueryAddress);

        if(!empty($bingMapsGeocodingData->latitude)){
            $locationCreateData->latitude = $bingMapsGeocodingData->latitude;
            $locationCreateData->longitude = $bingMapsGeocodingData->longitude;
        }elseif(isset($locationCreateData->cityObject) && isset($locationCreateData->cityObject['latitude']) && isset($locationCreateData->cityObject['longitude'])){
            $locationCreateData->latitude = $locationCreateData->cityObject['latitude'] ?? null;
            $locationCreateData->longitude = $locationCreateData->cityObject['longitude'] ?? null;
        }
        $newLocationId = $this->repository->insertLocation($locationCreateData);
        return $newLocationId;
    }
}
