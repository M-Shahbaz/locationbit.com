<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use DomainException;
use Elasticsearch\Client;
use Psr\Log\LoggerInterface;

/**
 * Repository.
 */
class UserReaderRepository
{
    private $client;
    private $loggerInterface;

    public function __construct(
        Client $client,
        LoggerInterface $loggerInterface)
    {
        $this->client = $client;
        $this->loggerInterface = $loggerInterface;
    }

    public function getUserById(string $id): UserData
    {
        $params = [
            'index' => 'users',
            'id'    => $id
        ];
        
        try {
            $row = (object)$this->client->getSource($params);
            $row->id = $id;
        } catch (\Throwable $th) {
            throw new DomainException(sprintf('User not found by id: %s', $id));
        }
        
        $userData = $this->getUserData($row);
        return $userData;

    }

    public function getUserByEmail(string $email): UserData
    {
        $params = [
            'index' => 'users',
            'size'   => 1, 
            'body'  => [
                'query' => [
                    'match_phrase_prefix' => [
                        'email' => $email
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        
        if (!isset($response['hits']['hits'][0]['_source'])) {
            throw new DomainException(sprintf('User not found by email: %s', $email));
        }

        $row = (object)$response['hits']['hits'][0]['_source'];
        $this->loggerInterface->info(print_r($response, true));
        $row->id = $response['hits']['hits'][0]['_id'];
        $this->loggerInterface->info(print_r($row, true));
        $userData = $this->getUserData($row);
        return $userData;

    }


    private function getUserData($row): UserData
    {

        $userData = new UserData();
        $userData->id = $row->id ? (string)$row->id : null;
        $userData->name = $row->name ? (string)$row->name : null;
        $userData->email = $row->email ? (string)$row->email : null;
        $userData->role = $row->role ? (int)$row->role : null;
        $userData->active = $row->active ? (int)$row->active : null;
        $userData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        // $userData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        // $userData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        // $userData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        // $userData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        // $userData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;
        
        return $userData;

    }

}
