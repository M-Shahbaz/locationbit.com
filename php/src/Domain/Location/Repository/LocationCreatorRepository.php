<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertLocation(LocationCreateData $locationCreateData): Int
    {

        $row = [
            'name' => $locationCreateData->name,
            'address' => $locationCreateData->address,
            'zipcode' => $locationCreateData->zipcode,
            'country' => $locationCreateData->country,
            'state' => $locationCreateData->state,
            'city' => $locationCreateData->city,
            'latitude' => $locationCreateData->latitude,
            'longitude' => $locationCreateData->longitude,
            'createdBy' => $locationCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('locations')->insertGetId($row);
        return $insId;
    }

}
