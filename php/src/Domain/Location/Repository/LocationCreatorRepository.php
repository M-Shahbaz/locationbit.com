<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationCreateData;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationCreatorRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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

}
