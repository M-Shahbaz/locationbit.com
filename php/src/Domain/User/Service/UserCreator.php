<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Repository\UserCreatorRepository;

/**
 * Service.
 */
final class UserCreator
{
    private $repository;

    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(UserCreateData $userCreateData): int
    {
        $newUserId = $this->repository->insertUser($userCreateData);
        return $newUserId;
    }
}