<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationLockData;
use App\Domain\Location\Data\LocationLockReadRequestData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationLockReaderRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getLocationLockByLocationIdAndField(string $locationId, string $field): LocationLockData
    {

        $row = $this->connection
                      ->table('location_lock')
                      ->where('locationId', $locationId)
                      ->where('field', $field)
                      ->first();

        if (!$row) {
            return new LocationLockData();
        }

        $locationLockData = new LocationLockData();
        $locationLockData->id = $row->id ? (int)$row->id : null;
        $locationLockData->locationId = $row->locationId ? (string)$row->locationId : null;
        $locationLockData->field = $row->field ? (string)$row->field : null;
        $locationLockData->lockOn = $row->lockOn ? (string)$row->lockOn : null;
        $locationLockData->disputed = $row->disputed ? (int)$row->disputed : null;
        $locationLockData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        $locationLockData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        $locationLockData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        $locationLockData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        $locationLockData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        $locationLockData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;
        
        return $locationLockData;

    }

}
