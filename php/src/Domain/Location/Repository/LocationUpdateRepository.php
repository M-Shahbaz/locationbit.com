<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationUpdateData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationUpdateRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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

}
