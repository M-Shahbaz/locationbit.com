<?php

namespace App\Domain\Location\Service;

use App\Domain\Bing\Service\BingMapsGeocodingReader;
use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Data\LocationHistoryCreateData;
use App\Domain\Location\Data\LocationMysqlCreateData;
use App\Domain\Location\Data\LocationShareCreateData;
use App\Domain\Location\Data\LocationTicketCreateData;
use App\Domain\Location\Repository\LocationCreatorRepository;

/**
 * Service.
 */
final class LocationCreator
{
    private $repository;
    private $bingMapsGeocodingReader;
    private $locationHistoryCreator;
    private $locationTicketCreator;
    private $locationShareCreator;

    public function __construct(
        LocationCreatorRepository $repository,
        BingMapsGeocodingReader $bingMapsGeocodingReader,
        LocationHistoryCreator $locationHistoryCreator,
        LocationTicketCreator $locationTicketCreator,
        LocationShareCreator $locationShareCreator
    ) {
        $this->repository = $repository;
        $this->bingMapsGeocodingReader = $bingMapsGeocodingReader;
        $this->locationHistoryCreator = $locationHistoryCreator;
        $this->locationTicketCreator = $locationTicketCreator;
        $this->locationShareCreator = $locationShareCreator;
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

        $tickets = 0;
        $locationShareCreateData = new LocationShareCreateData();
        $locationShareCreateData->locationId = $newLocationId ?? null;
        $locationShareCreateData->userId = $locationCreateData->createdBy;
        $locationShareCreateData->createdBy = $locationCreateData->createdBy;
        
        $locationMysqlCreateData = new LocationMysqlCreateData();
        $locationMysqlCreateData->locationId = $newLocationId ?? null;
        $locationMysqlCreateData->name = $locationCreateData->name;
        if(!empty($locationMysqlCreateData->name)){
            $tickets += TICKETS;
            $locationShareCreateData->name = 1;
        }
        $locationMysqlCreateData->nameBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->address = $locationCreateData->address;
        if(!empty($locationMysqlCreateData->address)){
            $tickets += TICKETS;
            $locationShareCreateData->address = 1;
        }
        $locationMysqlCreateData->addressBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->postcode = $locationCreateData->postcode;
        if(!empty($locationMysqlCreateData->postcode)){
            $tickets += TICKETS;
            $locationShareCreateData->postcode = 1;
        }
        $locationMysqlCreateData->postcodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->country = $locationCreateData->country;
        if(!empty($locationMysqlCreateData->country)){
            $tickets += TICKETS;
            $locationShareCreateData->country = 1;
        }
        $locationMysqlCreateData->countryBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->countrycode = $locationCreateData->countrycode;
        $locationMysqlCreateData->countrycodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->state = $locationCreateData->state;
        if(!empty($locationMysqlCreateData->state)){
            $tickets += TICKETS;
            $locationShareCreateData->state = 1;
        }
        $locationMysqlCreateData->stateBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->statecode = $locationCreateData->statecode;
        $locationMysqlCreateData->statecodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->city = $locationCreateData->city;
        if(!empty($locationMysqlCreateData->city)){
            $tickets += TICKETS;
            $locationShareCreateData->city = 1;
        }
        $locationMysqlCreateData->cityBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->lat = $locationCreateData->lat;
        $locationMysqlCreateData->lon = $locationCreateData->lon;
        if(isset($locationMysqlCreateData->lat)){
            $tickets += TICKETS;
            $locationShareCreateData->latlon = 1;
        }
        $locationMysqlCreateData->latlonBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->createdBy = $locationCreateData->createdBy;

        $locationMysqlCreateData->validate();

        $newLocationMysqlId = $this->repository->insertLocationMysql($locationMysqlCreateData);
        $this->locationShareCreator->createLocationShare($locationShareCreateData);

        
        $locationHistoryCreateData = new LocationHistoryCreateData();
        $locationHistoryCreateData->locationId = $newLocationId ?? null;
        $locationHistoryCreateData->table = "locations";
        $locationHistoryCreateData->field = "new";
        $locationHistoryCreateData->recordId = $newLocationMysqlId;
        $locationHistoryCreateData->oldValue = null;
        $locationHistoryCreateData->newValue = $locationCreateData->name;
        $locationHistoryCreateData->oldUserId = null;
        $locationHistoryCreateData->newUserId = $locationCreateData->createdBy;
        $locationHistoryCreateData->createdBy = $locationCreateData->createdBy;

        $this->locationHistoryCreator->createLocationHistory($locationHistoryCreateData);

        $locationTicketCreateData = new LocationTicketCreateData();
        $locationTicketCreateData->locationId = $newLocationId ?? null;
        $locationTicketCreateData->userId = $locationCreateData->createdBy;
        $locationTicketCreateData->field = 'new location';
        $locationTicketCreateData->status = null;
        $locationTicketCreateData->tickets = $tickets;
        $locationTicketCreateData->createdBy = $locationCreateData->createdBy;

        $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);

        return $newLocationId;
    }
}
