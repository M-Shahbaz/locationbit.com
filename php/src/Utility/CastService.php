<?php

namespace App\Utility;

use App\Domain\Jwt\Data\JwtUserData;

final class CastService
{    
    public static function castJwtUserData(JwtUserData $jwtUserData): JwtUserData
    {
        return $jwtUserData;
    }
    
}
