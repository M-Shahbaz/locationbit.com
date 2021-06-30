<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationData;
use App\Domain\Location\Data\LocationReadRequestData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationReaderRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getLocationById(int $id): LocationData
    {

        $row = $this->connection
            ->table('locations')
            ->where('id', $id)
            ->first();

        if (!$row) {
            throw new DomainException(sprintf('Location not found by id: %s', $id));
        }

        $locationData = new LocationData();
        $locationData->id = $row->id ? (int)$row->id : null;
        $locationData->name = $row->name ? (string)$row->name : null;
        $locationData->address = $row->address ? (string)$row->address : null;
        $locationData->zipcode = $row->zipcode ? (string)$row->zipcode : null;
        $locationData->country = $row->country ? (string)$row->country : null;
        $locationData->state = $row->state ? (string)$row->state : null;
        $locationData->city = $row->city ? (string)$row->city : null;
        $locationData->latitude = $row->latitude ? (float)$row->latitude : null;
        $locationData->longitude = $row->longitude ? (float)$row->longitude : null;
        $locationData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        $locationData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        $locationData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        $locationData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        $locationData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        $locationData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;

        return $locationData;
    }
}
