<?php

namespace App\Domain\Location\Service;

use App\Domain\Bing\Service\BingMapsGeocodingReader;
use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Data\LocationHistoryCreateData;
use App\Domain\Location\Data\LocationMysqlCreateData;
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

    public function __construct(
        LocationCreatorRepository $repository,
        BingMapsGeocodingReader $bingMapsGeocodingReader,
        LocationHistoryCreator $locationHistoryCreator,
        LocationTicketCreator $locationTicketCreator
    ) {
        $this->repository = $repository;
        $this->bingMapsGeocodingReader = $bingMapsGeocodingReader;
        $this->locationHistoryCreator = $locationHistoryCreator;
        $this->locationTicketCreator = $locationTicketCreator;
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

        $locationMysqlCreateData = new LocationMysqlCreateData();
        $locationMysqlCreateData->locationId = $newLocationId ?? null;
        $locationMysqlCreateData->name = $locationCreateData->name;
        if(!empty($locationMysqlCreateData->name)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->nameBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->address = $locationCreateData->address;
        if(!empty($locationMysqlCreateData->address)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->addressBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->postcode = $locationCreateData->postcode;
        if(!empty($locationMysqlCreateData->postcode)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->postcodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->country = $locationCreateData->country;
        $locationMysqlCreateData->countryBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->countrycode = $locationCreateData->countrycode;
        if(!empty($locationMysqlCreateData->countrycode)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->countrycodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->state = $locationCreateData->state;
        $locationMysqlCreateData->stateBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->statecode = $locationCreateData->statecode;
        if(!empty($locationMysqlCreateData->statecode)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->statecodeBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->city = $locationCreateData->city;
        if(!empty($locationMysqlCreateData->city)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->cityBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->lat = $locationCreateData->lat;
        $locationMysqlCreateData->lon = $locationCreateData->lon;
        if(isset($locationMysqlCreateData->lat)){
            $tickets += TICKETS;
        }
        $locationMysqlCreateData->latlonBy = $locationCreateData->createdBy;
        $locationMysqlCreateData->createdBy = $locationCreateData->createdBy;

        $locationMysqlCreateData->validate();

        $newLocationMysqlId = $this->repository->insertLocationMysql($locationMysqlCreateData);

        
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
