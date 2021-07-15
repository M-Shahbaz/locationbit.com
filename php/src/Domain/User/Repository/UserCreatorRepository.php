<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertUser(UserCreateData $userCreateData): Int
    {

        $row = [
            'name' => $userCreateData->name,
            'email' => $userCreateData->email,
            'role' => $userCreateData->role,
            'active' => $userCreateData->active,
            'createdBy' => $userCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('users')->insertGetId($row);
        return $insId;
    }

}