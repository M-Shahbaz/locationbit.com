<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationLockCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationLockCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertLocationLock(LocationLockCreateData $locationLockCreateData): Int
    {

        $row = [
            'locationId' => $locationLockCreateData->locationId,
            'field' => $locationLockCreateData->field,
            'lockOn' => $locationLockCreateData->lockOn,
            'disputed' => $locationLockCreateData->disputed,
            'createdBy' => $locationLockCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('location_lock')->insertGetId($row);
        return $insId;
    }

}
