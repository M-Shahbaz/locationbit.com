<?php

namespace App\Domain\User\Data;

use UnexpectedValueException;

final class UserCreateData
{
    /** @var string (varchar)*/
    public $name;      
    
    /** @var string (varchar)*/
    public $email;      
    
    /** @var int (tinyint)*/
    public $role;      
    
    /** @var int (tinyint)*/
    public $active;      
    
    /** @var int */
    public $createdBy;      
    
	private function validateUserCreateData() 
	{
		if(empty($this->email)){
			throw new UnexpectedValueException('email is required');
		}

		if(empty($this->role)){
			throw new UnexpectedValueException('role is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateUserCreateData':
				return $this->validateUserCreateData();
				break;
			
			default:
				return $this->validateUserCreateData();
				break;
			return false;
		}
    }
}