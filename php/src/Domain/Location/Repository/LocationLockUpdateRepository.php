<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationLockUpdateData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationLockUpdateRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function updateLocationLockByLocationIdAndField(Array $locationLockUpdateArray,  LocationLockUpdateData $locationLockUpdateData): Bool
    {

        $row = $locationLockUpdateArray;
        
        try {
            $numberOfaffectedRows = $this->connection->table('location_lock')
                             ->updateOrInsert(
                                [
                                    'locationId' => $locationLockUpdateData->locationId,
                                    'field' => $locationLockUpdateData->field,
                                ],
                                 $row);

            return $numberOfaffectedRows;
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        
        return false;
    }

}
