<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use App\Domain\User\Data\UserReadRequestData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserReaderRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getUserById(int $id): UserData
    {

        $row = $this->connection
                      ->table('users')
                      ->where('id', $id)
                      ->first();

        if (!$row) {
            throw new DomainException(sprintf('User not found by id: %s', $id));
        }

        $userData = $this->getUserData($row);
        return $userData;

    }

    public function getUserByEmail(string $email): UserData
    {

        $row = $this->connection
                      ->table('users')
                      ->where('email', $email)
                      ->first();

        if (!$row) {
            throw new DomainException(sprintf('User not found by email: %s', $email));
        }

        $userData = $this->getUserData($row);
        return $userData;

    }


    private function getUserData($row): UserData
    {

        $userData = new UserData();
        $userData->id = $row->id ? (int)$row->id : null;
        $userData->name = $row->name ? (string)$row->name : null;
        $userData->email = $row->email ? (string)$row->email : null;
        $userData->role = $row->role ? (int)$row->role : null;
        $userData->active = $row->active ? (int)$row->active : null;
        $userData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        $userData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        $userData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        $userData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        $userData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        $userData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;
        
        return $userData;

    }

}
