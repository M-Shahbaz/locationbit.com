<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationsSearchData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationsSearchRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function searchLocations(LocationsSearchData $filter): array
    {

        try {
            $params = [
                'index' => 'locations',
                'body'  => [
                    'query' => [
                        "multi_match" => [
                            "query" => $filter->q,
                            "fields" => [
                                "collector.default",
                                "collector.en"
                            ],
                            "type" => "most_fields"
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


    public function allLocations(LocationsSearchData $filter): array
    {

        try {
            $params = [
                'index' => 'locations',
                'body'  => [
                    'size' => $filter->limit,
                    'from' => $filter->offset,
                    'query' => [
                        "match_all" => (object)[]
                    ],
                    'track_total_hits' => true
                ]
            ];

            $results = $this->client->search($params);
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }

        return $results;
    }
}
