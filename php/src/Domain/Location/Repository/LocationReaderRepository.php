<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationData;
use App\Utility\LocationsService;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationReaderRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
}
