<?php

namespace App\Domain\Jwt\Data;

use UnexpectedValueException;

final class JwtCreateData
{
    /** @var timestamp */
    public $iat;      
    
    /** @var timestamp */
    public $nbf;      
    
    /** @var timestamp */
    public $exp;      
    
	private function validateJwtCreateData() 
	{
		if(empty($this->iat)){
			throw new UnexpectedValueException('iat is required');
		}

		if(empty($this->nbf)){
			throw new UnexpectedValueException('nbf is required');
		}

		if(empty($this->exp)){
			throw new UnexpectedValueException('exp is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateJwtCreateData':
				return $this->validateJwtCreateData();
				break;
			
			default:
				return $this->validateJwtCreateData();
				break;
			return false;
		}
    }
}