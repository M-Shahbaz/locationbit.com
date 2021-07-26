<?php

namespace App\Domain\Jwt\Service;

use App\Domain\Jwt\Data\JwtCreateData;
use App\Domain\Jwt\Data\JwtTokenReCreateData;
use App\Domain\Jwt\Data\JwtUserData;
use App\Domain\Jwt\Repository\JwtTokenReCreatorRepository;

/**
 * Service.
 */
final class JwtTokenReCreator
{
    private $jwtCreator;

    public function __construct(JwtCreator $jwtCreator)
    {
        $this->jwtCreator = $jwtCreator;
    }

    public function reCreateJwtToken(JwtUserData $jwtUserData): string
    {
        $now = new \DateTime();
        $future = new \DateTime("+30 days");

        $jwtCreateData = new JwtCreateData();
        $jwtCreateData->iat = $now->getTimeStamp();
        $jwtCreateData->nbf = $now->getTimeStamp();
        $jwtCreateData->exp = $future->getTimeStamp();
        $jwtCreateData->userId = $jwtUserData->userId;
        $jwtCreateData->name = $jwtUserData->name;
        $jwtCreateData->role = $jwtUserData->role;
        $jwtCreateData->email = $jwtUserData->email;


        $jwt = $this->jwtCreator->createJwt($jwtCreateData);
        return $jwt;
    }
}