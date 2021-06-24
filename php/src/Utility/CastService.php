<?php

namespace App\Utility;

use App\Domain\Jwt\Data\JwtUserData;

final class CastService
{
    public static function castJwtUserData(array $jwt): JwtUserData
    {
        $jwtUserData = new JwtUserData();
        $jwtUserData->userId = $jwt['userId'] ?? null;
        $jwtUserData->name = $jwt['name'] ?? null;
        $jwtUserData->picture = $jwt['picture'] ?? null;
        $jwtUserData->email = $jwt['email'] ?? null;
        $jwtUserData->role = $jwt['role'] ?? null;
        $jwtUserData->sub = $jwt['sub'] ?? null;
        $jwtUserData->iss = $jwt['iss'] ?? null;
        $jwtUserData->jti = $jwt['jti'] ?? null;
        $jwtUserData->iat = $jwt['iat'] ?? null;
        $jwtUserData->nbf = $jwt['nbf'] ?? null;
        $jwtUserData->exp = $jwt['exp'] ?? null;
        return $jwtUserData;
    }
}
