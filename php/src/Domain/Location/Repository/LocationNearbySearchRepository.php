<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationNearbySearchData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationNearbySearchRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchLocationNearby(LocationNearbySearchData $filter): array
    {

        try {
            $params = [
                'index' => 'locations',
                'body'  => [
                    'from' => $filter->offset ?? 0,
                    'size' => $filter->limit ?? 10,
                    'query' => [
                        "bool" => [
                            "must" =>  [
                                "match_all" => (object)[]
                            ],
                            "filter" => [
                                "geo_distance" => [
                                    "distance" => $filter->distance ?? "300m",
                                    "coordinate" => [
                                        "lat" => $filter->lat,
                                        "lon" => $filter->lon
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
            ];

            $results = $this->client->search($params);
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }

        return $results;
    }
}
