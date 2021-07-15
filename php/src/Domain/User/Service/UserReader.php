<?php

namespace App\Domain\User\Service;

use App\Domain\Jwt\Data\JwtUserData;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserReaderRepository;

/**
 * Service.
 */
final class UserReader
{
    private $repository;
    private $userCreator;

    public function __construct(
        UserReaderRepository $repository,
        UserCreator $userCreator
    ) {
        $this->repository = $repository;
        $this->userCreator = $userCreator;
    }


    public function getUserById(int $id): UserData
    {

        $userData = $this->repository->getUserById($id);
        return $userData;
    }

    public function getUserByJwtUserDataEmail(JwtUserData $jwtUserData): UserData
    {
        try {
            $userData = $this->repository->getUserByEmail($jwtUserData->email);
        } catch (\Throwable $th) {

            $userCreateData = new UserCreateData();
            $userCreateData->name = $jwtUserData->name;
            $userCreateData->email = $jwtUserData->email;
            $userCreateData->role = 1;
            $userCreateData->active = 1;

            $newUserId = $this->userCreator->createUser($userCreateData);

            $userData = $this->getUserById($newUserId);
        }

        return $userData;
    }
}
