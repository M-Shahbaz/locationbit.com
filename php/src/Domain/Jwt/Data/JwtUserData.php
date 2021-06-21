<?php

namespace App\Domain\Jwt\Data;

final class JwtUserData
{
    /** @var int */
    public $userId;      
    
    /** @var string */
    public $name;      
    
    /** @var string */
    public $email;      
    
    /** @var string */
    public $role;  
    
    /** @var string */
    public $sub;      
    
    /** @var string */
    public $iss;      
    
    /** @var string */
    public $jti;
    
    /** @var string */
    public $iat;      
    
    /** @var string */
    public $nbf;      
    
    /** @var string */
    public $exp;
	
}