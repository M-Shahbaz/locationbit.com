<?php

namespace App\Domain\Jwt\Service;

use App\Domain\Jwt\Data\JwtAuthData;
use App\Domain\Jwt\Data\JwtCreateData;

/**
 * Service.
 */
final class JwtCreator
{
    //private $userAuth;
    private $jwtAuth;

    public function __construct( //UserAuth $userAuth,
        JwtAuth $jwtAuth
    ) {
        //$this->userAuth = $userAuth;
        $this->jwtAuth = $jwtAuth;
    }

    public function createJwt(JwtCreateData $jwtCreateData): ?String
    {

        $jwtAuthData = new JwtAuthData();

        $jwtAuthData->userId = $jwtCreateData->userId;
        $jwtAuthData->name = $jwtCreateData->name;
        $jwtAuthData->role = $jwtCreateData->role;
        $jwtAuthData->email = $jwtCreateData->email;
        $jwtAuthData->iat = $jwtCreateData->iat;
        $jwtAuthData->nbf = $jwtCreateData->nbf;
        $jwtAuthData->exp = $jwtCreateData->exp;


        $jwtAuthData->validate();

        $jwtToken = $this->jwtAuth->createJwt($jwtAuthData);

        return $jwtToken;
    }
}
