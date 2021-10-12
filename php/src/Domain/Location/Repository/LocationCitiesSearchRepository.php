<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationCitiesSearchData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationCitiesSearchRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchLocationCities(LocationCitiesSearchData $filter): array
    {

        try {
            $params = [
                'index' => 'locations',
                'body'  => [
                    'from' => $filter->offset,
                    'size' => $filter->limit,
                    'query' => [
                        "simple_query_string" => [
                            "query" => $filter->city,
                            "fields" => [
                                "city.en"
                            ],
                            "default_operator" => "and"
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
