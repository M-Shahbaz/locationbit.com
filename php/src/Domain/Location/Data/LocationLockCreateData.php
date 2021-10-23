<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationLockCreateData
{
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var string (varchar)*/
    public $field;      
    
    /** @var string (datetime)*/
    public $lockOn;      
    
    /** @var int (tinyint)*/
    public $disputed;

    /** @var int */
    public $createdBy;      
    
	private function validateLocationLockCreateData() 
	{
		if(empty($this->locationId)){
			throw new UnexpectedValueException('locationId is required');
		}

		if(empty($this->field)){
			throw new UnexpectedValueException('field is required');
		}

		if(empty($this->lockOn)){
			throw new UnexpectedValueException('lockOn is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationLockCreateData':
				return $this->validateLocationLockCreateData();
				break;
			
			default:
				return $this->validateLocationLockCreateData();
				break;
			return false;
		}
    }
}