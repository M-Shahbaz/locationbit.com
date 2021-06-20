<?php

namespace App\Domain\Jwt\Service;

use App\Domain\Jwt\Data\JwtCreateData;
use App\Domain\Jwt\Data\JwtTokenReCreateData;
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

    public function reCreateJwtToken(string $email): string
    {
        $now = new \DateTime();
        $future = new \DateTime("+30 days");

        $jwtCreateData = new JwtCreateData();
        $jwtCreateData->iat = $now->getTimeStamp();
        $jwtCreateData->nbf = $now->getTimeStamp();
        $jwtCreateData->exp = $future->getTimeStamp();


        $jwt = $this->jwtCreator->createJwt($email, $jwtCreateData);
        return $jwt;
    }
}