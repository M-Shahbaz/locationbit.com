<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationData;
use App\Domain\Location\Data\LocationMysqlData;
use App\Utility\LocationsService;
use DomainException;
use Elasticsearch\Client;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationReaderRepository
{
    private $client;
    private $connection;

    public function __construct(
        Client $client,
        Connection $connection
    ) {
        $this->client = $client;
        $this->connection = $connection;
    }

    public function getLocationById(string $id): LocationData
    {

        $params = [
            'index' => 'locations',
            'id'    => $id
        ];

        try {
            $row = (object)$this->client->getSource($params);
            $row->id = $id;
        } catch (\Throwable $th) {
            throw new DomainException(sprintf('Location not found by id: %s', $id));
        }

        return LocationsService::returnLocationData($row);
    }

    public function getLocationMysqlByLocationId(string $locationId): LocationMysqlData
    {

        $row = $this->connection
                      ->table('locations')
                      ->where('locationId', $locationId)
                      ->first();

        if (!$row) {
            return new LocationMysqlData();
        }

        $locationMysqlData = new LocationMysqlData();
        $locationMysqlData->id = $row->id ? (int)$row->id : null;
        $locationMysqlData->locationId = $row->locationId ? (string)$row->locationId : null;
        $locationMysqlData->name = $row->name ? (string)$row->name : null;
        $locationMysqlData->nameBy = $row->nameBy ? (int)$row->nameBy : null;
        $locationMysqlData->nameOn = $row->nameOn ? (string)$row->nameOn : null;
        $locationMysqlData->description = $row->description ? (string)$row->description : null;
        $locationMysqlData->descriptionBy = $row->descriptionBy ? (int)$row->descriptionBy : null;
        $locationMysqlData->descriptionOn = $row->descriptionOn ? (string)$row->descriptionOn : null;
        $locationMysqlData->address = $row->address ? (string)$row->address : null;
        $locationMysqlData->addressBy = $row->addressBy ? (int)$row->addressBy : null;
        $locationMysqlData->addressOn = $row->addressOn ? (string)$row->addressOn : null;
        $locationMysqlData->postcode = $row->postcode ? (string)$row->postcode : null;
        $locationMysqlData->postcodeBy = $row->postcodeBy ? (int)$row->postcodeBy : null;
        $locationMysqlData->postcodeOn = $row->postcodeOn ? (string)$row->postcodeOn : null;
        $locationMysqlData->country = $row->country ? (string)$row->country : null;
        $locationMysqlData->countryBy = $row->countryBy ? (int)$row->countryBy : null;
        $locationMysqlData->countryOn = $row->countryOn ? (string)$row->countryOn : null;
        $locationMysqlData->countrycode = $row->countrycode ? (string)$row->countrycode : null;
        $locationMysqlData->countrycodeBy = $row->countrycodeBy ? (int)$row->countrycodeBy : null;
        $locationMysqlData->countrycodeOn = $row->countrycodeOn ? (string)$row->countrycodeOn : null;
        $locationMysqlData->state = $row->state ? (string)$row->state : null;
        $locationMysqlData->stateBy = $row->stateBy ? (int)$row->stateBy : null;
        $locationMysqlData->stateOn = $row->stateOn ? (string)$row->stateOn : null;
        $locationMysqlData->statecode = $row->statecode ? (string)$row->statecode : null;
        $locationMysqlData->statecodeBy = $row->statecodeBy ? (int)$row->statecodeBy : null;
        $locationMysqlData->statecodeOn = $row->statecodeOn ? (string)$row->statecodeOn : null;
        $locationMysqlData->city = $row->city ? (string)$row->city : null;
        $locationMysqlData->cityBy = $row->cityBy ? (int)$row->cityBy : null;
        $locationMysqlData->cityOn = $row->cityOn ? (string)$row->cityOn : null;
        $locationMysqlData->lat = $row->lat ? (float)$row->lat : null;
        $locationMysqlData->lon = $row->lon ? (float)$row->lon : null;
        $locationMysqlData->latlonBy = $row->latlonBy ? (int)$row->latlonBy : null;
        $locationMysqlData->latlonOn = $row->latlonOn ? (string)$row->latlonOn : null;
        $locationMysqlData->website = $row->website ? (string)$row->website : null;
        $locationMysqlData->websiteBy = $row->websiteBy ? (int)$row->websiteBy : null;
        $locationMysqlData->websiteOn = $row->websiteOn ? (string)$row->websiteOn : null;
        $locationMysqlData->email = $row->email ? (string)$row->email : null;
        $locationMysqlData->emailBy = $row->emailBy ? (int)$row->emailBy : null;
        $locationMysqlData->emailOn = $row->emailOn ? (string)$row->emailOn : null;
        $locationMysqlData->phone = $row->phone ? (string)$row->phone : null;
        $locationMysqlData->phoneBy = $row->phoneBy ? (int)$row->phoneBy : null;
        $locationMysqlData->phoneOn = $row->phoneOn ? (string)$row->phoneOn : null;
        $locationMysqlData->googleMaps = $row->googleMaps ? (string)$row->googleMaps : null;
        $locationMysqlData->googleMapsBy = $row->googleMapsBy ? (int)$row->googleMapsBy : null;
        $locationMysqlData->googleMapsOn = $row->googleMapsOn ? (string)$row->googleMapsOn : null;
        $locationMysqlData->googleStreetView = $row->googleStreetView ? (string)$row->googleStreetView : null;
        $locationMysqlData->googleStreetViewBy = $row->googleStreetViewBy ? (int)$row->googleStreetViewBy : null;
        $locationMysqlData->googleStreetViewOn = $row->googleStreetViewOn ? (string)$row->googleStreetViewOn : null;
        $locationMysqlData->facebook = $row->facebook ? (string)$row->facebook : null;
        $locationMysqlData->facebookBy = $row->facebookBy ? (int)$row->facebookBy : null;
        $locationMysqlData->facebookOn = $row->facebookOn ? (string)$row->facebookOn : null;
        $locationMysqlData->twitter = $row->twitter ? (string)$row->twitter : null;
        $locationMysqlData->twitterBy = $row->twitterBy ? (int)$row->twitterBy : null;
        $locationMysqlData->twitterOn = $row->twitterOn ? (string)$row->twitterOn : null;
        $locationMysqlData->instagram = $row->instagram ? (string)$row->instagram : null;
        $locationMysqlData->instagramBy = $row->instagramBy ? (int)$row->instagramBy : null;
        $locationMysqlData->instagramOn = $row->instagramOn ? (string)$row->instagramOn : null;
        $locationMysqlData->youtube = $row->youtube ? (string)$row->youtube : null;
        $locationMysqlData->youtubeBy = $row->youtubeBy ? (int)$row->youtubeBy : null;
        $locationMysqlData->youtubeOn = $row->youtubeOn ? (string)$row->youtubeOn : null;
        $locationMysqlData->linkedin = $row->linkedin ? (string)$row->linkedin : null;
        $locationMysqlData->linkedinBy = $row->linkedinBy ? (int)$row->linkedinBy : null;
        $locationMysqlData->linkedinOn = $row->linkedinOn ? (string)$row->linkedinOn : null;
        $locationMysqlData->telegram = $row->telegram ? (string)$row->telegram : null;
        $locationMysqlData->telegramBy = $row->telegramBy ? (int)$row->telegramBy : null;
        $locationMysqlData->telegramOn = $row->telegramOn ? (string)$row->telegramOn : null;
        $locationMysqlData->sector = $row->sector ? (string)$row->sector : null;
        $locationMysqlData->sectorBy = $row->sectorBy ? (int)$row->sectorBy : null;
        $locationMysqlData->sectorOn = $row->sectorOn ? (string)$row->sectorOn : null;
        $locationMysqlData->subSector = $row->subSector ? (string)$row->subSector : null;
        $locationMysqlData->subSectorBy = $row->subSectorBy ? (int)$row->subSectorBy : null;
        $locationMysqlData->subSectorOn = $row->subSectorOn ? (string)$row->subSectorOn : null;
        $locationMysqlData->industryGroup = $row->industryGroup ? (string)$row->industryGroup : null;
        $locationMysqlData->industryGroupBy = $row->industryGroupBy ? (int)$row->industryGroupBy : null;
        $locationMysqlData->industryGroupOn = $row->industryGroupOn ? (string)$row->industryGroupOn : null;
        $locationMysqlData->naicsIndustry = $row->naicsIndustry ? (string)$row->naicsIndustry : null;
        $locationMysqlData->naicsIndustryBy = $row->naicsIndustryBy ? (int)$row->naicsIndustryBy : null;
        $locationMysqlData->naicsIndustryOn = $row->naicsIndustryOn ? (string)$row->naicsIndustryOn : null;
        $locationMysqlData->nationalIndustry = $row->nationalIndustry ? (string)$row->nationalIndustry : null;
        $locationMysqlData->nationalIndustryBy = $row->nationalIndustryBy ? (int)$row->nationalIndustryBy : null;
        $locationMysqlData->nationalIndustryOn = $row->nationalIndustryOn ? (string)$row->nationalIndustryOn : null;
        $locationMysqlData->hoursMondayFrom = $row->hoursMondayFrom ? (string)$row->hoursMondayFrom : null;
        $locationMysqlData->hoursMondayFromBy = $row->hoursMondayFromBy ? (int)$row->hoursMondayFromBy : null;
        $locationMysqlData->hoursMondayFromOn = $row->hoursMondayFromOn ? (string)$row->hoursMondayFromOn : null;
        $locationMysqlData->hoursMondayTo = $row->hoursMondayTo ? (string)$row->hoursMondayTo : null;
        $locationMysqlData->hoursMondayToBy = $row->hoursMondayToBy ? (int)$row->hoursMondayToBy : null;
        $locationMysqlData->hoursMondayToOn = $row->hoursMondayToOn ? (string)$row->hoursMondayToOn : null;
        $locationMysqlData->hoursTuesdayFrom = $row->hoursTuesdayFrom ? (string)$row->hoursTuesdayFrom : null;
        $locationMysqlData->hoursTuesdayFromBy = $row->hoursTuesdayFromBy ? (int)$row->hoursTuesdayFromBy : null;
        $locationMysqlData->hoursTuesdayFromOn = $row->hoursTuesdayFromOn ? (string)$row->hoursTuesdayFromOn : null;
        $locationMysqlData->hoursTuesdayTo = $row->hoursTuesdayTo ? (string)$row->hoursTuesdayTo : null;
        $locationMysqlData->hoursTuesdayToBy = $row->hoursTuesdayToBy ? (int)$row->hoursTuesdayToBy : null;
        $locationMysqlData->hoursTuesdayToOn = $row->hoursTuesdayToOn ? (string)$row->hoursTuesdayToOn : null;
        $locationMysqlData->hoursWednesdayFrom = $row->hoursWednesdayFrom ? (string)$row->hoursWednesdayFrom : null;
        $locationMysqlData->hoursWednesdayFromBy = $row->hoursWednesdayFromBy ? (int)$row->hoursWednesdayFromBy : null;
        $locationMysqlData->hoursWednesdayFromOn = $row->hoursWednesdayFromOn ? (string)$row->hoursWednesdayFromOn : null;
        $locationMysqlData->hoursWednesdayTo = $row->hoursWednesdayTo ? (string)$row->hoursWednesdayTo : null;
        $locationMysqlData->hoursWednesdayToBy = $row->hoursWednesdayToBy ? (int)$row->hoursWednesdayToBy : null;
        $locationMysqlData->hoursWednesdayToOn = $row->hoursWednesdayToOn ? (string)$row->hoursWednesdayToOn : null;
        $locationMysqlData->hoursThursdayFrom = $row->hoursThursdayFrom ? (string)$row->hoursThursdayFrom : null;
        $locationMysqlData->hoursThursdayFromBy = $row->hoursThursdayFromBy ? (int)$row->hoursThursdayFromBy : null;
        $locationMysqlData->hoursThursdayFromOn = $row->hoursThursdayFromOn ? (string)$row->hoursThursdayFromOn : null;
        $locationMysqlData->hoursThursdayTo = $row->hoursThursdayTo ? (string)$row->hoursThursdayTo : null;
        $locationMysqlData->hoursThursdayToBy = $row->hoursThursdayToBy ? (int)$row->hoursThursdayToBy : null;
        $locationMysqlData->hoursThursdayToOn = $row->hoursThursdayToOn ? (string)$row->hoursThursdayToOn : null;
        $locationMysqlData->hoursFridayFrom = $row->hoursFridayFrom ? (string)$row->hoursFridayFrom : null;
        $locationMysqlData->hoursFridayFromBy = $row->hoursFridayFromBy ? (int)$row->hoursFridayFromBy : null;
        $locationMysqlData->hoursFridayFromOn = $row->hoursFridayFromOn ? (string)$row->hoursFridayFromOn : null;
        $locationMysqlData->hoursFridayTo = $row->hoursFridayTo ? (string)$row->hoursFridayTo : null;
        $locationMysqlData->hoursFridayToBy = $row->hoursFridayToBy ? (int)$row->hoursFridayToBy : null;
        $locationMysqlData->hoursFridayToOn = $row->hoursFridayToOn ? (string)$row->hoursFridayToOn : null;
        $locationMysqlData->hoursSaturdayFrom = $row->hoursSaturdayFrom ? (string)$row->hoursSaturdayFrom : null;
        $locationMysqlData->hoursSaturdayFromBy = $row->hoursSaturdayFromBy ? (int)$row->hoursSaturdayFromBy : null;
        $locationMysqlData->hoursSaturdayFromOn = $row->hoursSaturdayFromOn ? (string)$row->hoursSaturdayFromOn : null;
        $locationMysqlData->hoursSaturdayTo = $row->hoursSaturdayTo ? (string)$row->hoursSaturdayTo : null;
        $locationMysqlData->hoursSaturdayToBy = $row->hoursSaturdayToBy ? (int)$row->hoursSaturdayToBy : null;
        $locationMysqlData->hoursSaturdayToOn = $row->hoursSaturdayToOn ? (string)$row->hoursSaturdayToOn : null;
        $locationMysqlData->hoursSundayFrom = $row->hoursSundayFrom ? (string)$row->hoursSundayFrom : null;
        $locationMysqlData->hoursSundayFromBy = $row->hoursSundayFromBy ? (int)$row->hoursSundayFromBy : null;
        $locationMysqlData->hoursSundayFromOn = $row->hoursSundayFromOn ? (string)$row->hoursSundayFromOn : null;
        $locationMysqlData->hoursSundayTo = $row->hoursSundayTo ? (string)$row->hoursSundayTo : null;
        $locationMysqlData->hoursSundayToBy = $row->hoursSundayToBy ? (int)$row->hoursSundayToBy : null;
        $locationMysqlData->hoursSundayToOn = $row->hoursSundayToOn ? (string)$row->hoursSundayToOn : null;
        $locationMysqlData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        $locationMysqlData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        $locationMysqlData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        $locationMysqlData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        $locationMysqlData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        $locationMysqlData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;
        
        return $locationMysqlData;

    }

}
