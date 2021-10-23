<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationMysqlUpdateData;
use App\Domain\Location\Data\LocationUpdateData;
use DomainException;
use Elasticsearch\Client;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationUpdateRepository
{
    private $client;
    private $connection;

    public function __construct(
        Client $client,
        Connection $connection
    ) {
        $this->client = $client;
        $this->connection = $connection;
    }

    public function updateLocation(Array $locationUpdateArray,  LocationUpdateData $locationUpdateData): ?string
    {

        $row = $locationUpdateArray;
        
        try {
            $params = [
                'index' => 'locations',
                'id'    => $locationUpdateData->id,
                'body'  => [
                    'doc' => $row
                ]
            ];
    
            $response = $this->client->update($params);
            return $response['result'];
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        
        return null;
    }
    
    public function updateLocationMysqlByLocationId(Array $locationMysqlUpdateArray,  LocationMysqlUpdateData $locationMysqlUpdateData): Bool
    {

        $row = $locationMysqlUpdateArray;
        
        try {
            $numberOfaffectedRows = $this->connection->table('locations')
                             ->whereNull('deletedOn')
                             ->updateOrInsert(
                                [
                                    'locationId' => $locationMysqlUpdateData->locationId
                                ]
                             ,$row);

            return $numberOfaffectedRows;
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        
        return false;
    }

}
