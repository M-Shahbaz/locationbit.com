<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Data\LocationMysqlCreateData;
use Elasticsearch\Client;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationCreatorRepository
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

    public function insertLocation(LocationCreateData $locationCreateData): string
    {

        $row = [
            'name' => [
                'default' => $locationCreateData->name
            ],
            'street' => [
                'en' => $locationCreateData->address
            ],
            'postcode' => $locationCreateData->postcode,
            'country' => [
                'en' => $locationCreateData->country
            ],
            'countrycode' => $locationCreateData->countrycode,
            'statecode' => $locationCreateData->statecode,
            'state' => [
                'en' => $locationCreateData->state
            ],
            'city' => [
                'en' => $locationCreateData->city
            ],
            'coordinate' => [
                'lat' => $locationCreateData->lat,
                'lon' => $locationCreateData->lon
            ],
        ];

        $params = [
            'index' => 'locations',
            'body'  => $row
        ];

        $response = $this->client->index($params);
        return $response['_id'];
    }


    public function insertLocationMysql(LocationMysqlCreateData $locationMysqlCreateData): Int
    {

        $row = [
            'locationId' => $locationMysqlCreateData->locationId,
            'name' => $locationMysqlCreateData->name,
            'nameBy' => $locationMysqlCreateData->nameBy,
            'description' => $locationMysqlCreateData->description,
            'descriptionBy' => $locationMysqlCreateData->descriptionBy,
            'address' => $locationMysqlCreateData->address,
            'addressBy' => $locationMysqlCreateData->addressBy,
            'postcode' => $locationMysqlCreateData->postcode,
            'postcodeBy' => $locationMysqlCreateData->postcodeBy,
            'country' => $locationMysqlCreateData->country,
            'countryBy' => $locationMysqlCreateData->countryBy,
            'countrycode' => $locationMysqlCreateData->countrycode,
            'countrycodeBy' => $locationMysqlCreateData->countrycodeBy,
            'state' => $locationMysqlCreateData->state,
            'stateBy' => $locationMysqlCreateData->stateBy,
            'statecode' => $locationMysqlCreateData->statecode,
            'statecodeBy' => $locationMysqlCreateData->statecodeBy,
            'city' => $locationMysqlCreateData->city,
            'cityBy' => $locationMysqlCreateData->cityBy,
            'lat' => $locationMysqlCreateData->lat,
            'lon' => $locationMysqlCreateData->lon,
            'latlonBy' => $locationMysqlCreateData->latlonBy,
            'website' => $locationMysqlCreateData->website,
            'websiteBy' => $locationMysqlCreateData->websiteBy,
            'email' => $locationMysqlCreateData->email,
            'emailBy' => $locationMysqlCreateData->emailBy,
            'phone' => $locationMysqlCreateData->phone,
            'phoneBy' => $locationMysqlCreateData->phoneBy,
            'googleMaps' => $locationMysqlCreateData->googleMaps,
            'googleMapsBy' => $locationMysqlCreateData->googleMapsBy,
            'googleStreetView' => $locationMysqlCreateData->googleStreetView,
            'googleStreetViewBy' => $locationMysqlCreateData->googleStreetViewBy,
            'facebook' => $locationMysqlCreateData->facebook,
            'facebookBy' => $locationMysqlCreateData->facebookBy,
            'twitter' => $locationMysqlCreateData->twitter,
            'twitterBy' => $locationMysqlCreateData->twitterBy,
            'instagram' => $locationMysqlCreateData->instagram,
            'instagramBy' => $locationMysqlCreateData->instagramBy,
            'youtube' => $locationMysqlCreateData->youtube,
            'youtubeBy' => $locationMysqlCreateData->youtubeBy,
            'linkedin' => $locationMysqlCreateData->linkedin,
            'linkedinBy' => $locationMysqlCreateData->linkedinBy,
            'telegram' => $locationMysqlCreateData->telegram,
            'telegramBy' => $locationMysqlCreateData->telegramBy,
            'sector' => $locationMysqlCreateData->sector,
            'sectorBy' => $locationMysqlCreateData->sectorBy,
            'subSector' => $locationMysqlCreateData->subSector,
            'subSectorBy' => $locationMysqlCreateData->subSectorBy,
            'industryGroup' => $locationMysqlCreateData->industryGroup,
            'industryGroupBy' => $locationMysqlCreateData->industryGroupBy,
            'naicsIndustry' => $locationMysqlCreateData->naicsIndustry,
            'naicsIndustryBy' => $locationMysqlCreateData->naicsIndustryBy,
            'nationalIndustry' => $locationMysqlCreateData->nationalIndustry,
            'nationalIndustryBy' => $locationMysqlCreateData->nationalIndustryBy,
            'hoursMondayFrom' => $locationMysqlCreateData->hoursMondayFrom,
            'hoursMondayFromBy' => $locationMysqlCreateData->hoursMondayFromBy,
            'hoursMondayTo' => $locationMysqlCreateData->hoursMondayTo,
            'hoursMondayToBy' => $locationMysqlCreateData->hoursMondayToBy,
            'hoursTuesdayFrom' => $locationMysqlCreateData->hoursTuesdayFrom,
            'hoursTuesdayFromBy' => $locationMysqlCreateData->hoursTuesdayFromBy,
            'hoursTuesdayTo' => $locationMysqlCreateData->hoursTuesdayTo,
            'hoursTuesdayToBy' => $locationMysqlCreateData->hoursTuesdayToBy,
            'hoursWednesdayFrom' => $locationMysqlCreateData->hoursWednesdayFrom,
            'hoursWednesdayFromBy' => $locationMysqlCreateData->hoursWednesdayFromBy,
            'hoursWednesdayTo' => $locationMysqlCreateData->hoursWednesdayTo,
            'hoursWednesdayToBy' => $locationMysqlCreateData->hoursWednesdayToBy,
            'hoursThursdayFrom' => $locationMysqlCreateData->hoursThursdayFrom,
            'hoursThursdayFromBy' => $locationMysqlCreateData->hoursThursdayFromBy,
            'hoursThursdayTo' => $locationMysqlCreateData->hoursThursdayTo,
            'hoursThursdayToBy' => $locationMysqlCreateData->hoursThursdayToBy,
            'hoursFridayFrom' => $locationMysqlCreateData->hoursFridayFrom,
            'hoursFridayFromBy' => $locationMysqlCreateData->hoursFridayFromBy,
            'hoursFridayTo' => $locationMysqlCreateData->hoursFridayTo,
            'hoursFridayToBy' => $locationMysqlCreateData->hoursFridayToBy,
            'hoursSaturdayFrom' => $locationMysqlCreateData->hoursSaturdayFrom,
            'hoursSaturdayFromBy' => $locationMysqlCreateData->hoursSaturdayFromBy,
            'hoursSaturdayTo' => $locationMysqlCreateData->hoursSaturdayTo,
            'hoursSaturdayToBy' => $locationMysqlCreateData->hoursSaturdayToBy,
            'hoursSundayFrom' => $locationMysqlCreateData->hoursSundayFrom,
            'hoursSundayFromBy' => $locationMysqlCreateData->hoursSundayFromBy,
            'hoursSundayTo' => $locationMysqlCreateData->hoursSundayTo,
            'hoursSundayToBy' => $locationMysqlCreateData->hoursSundayToBy,
            'createdBy' => $locationMysqlCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('locations')->insertGetId($row);
        return $insId;
    }
}
