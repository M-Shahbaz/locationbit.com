<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationShareUpdateData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationShareUpdateRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function updateLocationShare(array $locationShareUpdateArray,  LocationShareUpdateData $locationShareUpdateData): Bool
    {

        $row = $locationShareUpdateArray;

        try {
            $numberOfaffectedRows = $this->connection->table('location_shares')
                ->updateOrInsert(
                    [
                        'locationId' => $locationShareUpdateData->locationId,
                        'userId' => $locationShareUpdateData->userId,
                    ],
                    $row
                );

            return $numberOfaffectedRows;
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }

        return false;
    }
}
