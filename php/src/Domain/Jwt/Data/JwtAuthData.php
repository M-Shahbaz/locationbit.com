<?php

namespace App\Domain\Jwt\Data;

use UnexpectedValueException;

final class JwtAuthData
{
    /** @var int */
    public $userId;      
    
    /** @var string */
    public $name;      
    
    /** @var string */
    public $email;      
    
    /** @var int */
    public $role;      
    
    /** @var string */
    public $iat;      
    
    /** @var string */
    public $nbf;      
    
    /** @var string */
    public $exp;
	
	private function validateJwtAuthData() 
	{
		// if(empty($this->userId)){
		// 	throw new UnexpectedValueException('userId is required');
		// }

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateJwtAuthData':
				return $this->validateJwtAuthData();
				break;
			
			default:
				return $this->validateJwtAuthData();
				break;
			return false;
		}
    }
}