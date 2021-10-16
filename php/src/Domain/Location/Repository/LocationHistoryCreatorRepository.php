<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationHistoryCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationHistoryCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertLocationHistory(LocationHistoryCreateData $locationHistoryCreateData): Int
    {

        $row = [
            'locationId' => $locationHistoryCreateData->locationId,
            'table' => $locationHistoryCreateData->table,
            'field' => $locationHistoryCreateData->field,
            'recordId' => $locationHistoryCreateData->recordId,
            'oldValue' => $locationHistoryCreateData->oldValue,
            'newValue' => $locationHistoryCreateData->newValue,
            'oldUserId' => $locationHistoryCreateData->oldUserId,
            'newUserId' => $locationHistoryCreateData->newUserId,
            'createdBy' => $locationHistoryCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('location_history')->insertGetId($row);
        return $insId;
    }

}
