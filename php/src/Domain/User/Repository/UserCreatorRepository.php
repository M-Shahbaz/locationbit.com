<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use Elasticsearch\Client;

/**
 * Repository.
 */
class UserCreatorRepository
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function insertUser(UserCreateData $userCreateData): ?string
    {

        $row = [
            'name' => $userCreateData->name,
            'email' => $userCreateData->email,
            'role' => $userCreateData->role,
            'active' => $userCreateData->active,
            'createdBy' => $userCreateData->createdBy,
        ];

        $params = [
            'index' => 'users',
            'body'  => $row
        ];
        
        $response = $this->client->index($params);
        return $response['_id'];
    }
}
