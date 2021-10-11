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



    public function getTotalResultCount(): ?int
    {

        try {
            $row = $this->connection
                ->select($this->connection->raw("SELECT FOUND_ROWS() AS TotalResultCount;"))[0]->TotalResultCount;
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }

        return $row;
    }
}
