<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationLockUpdateData
{
    /** @var int */
    public $id;      
    
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var string (varchar)*/
    public $field;      
    
    /** @var string (datetime)*/
    public $lockOn;      
    
    /** @var int (tinyint)*/
    public $disputed;         
    
    /** @var int */
	public $updatedBy;      
	
	private function validateLocationLockUpdateData() 
	{
		if(empty($this->locationId)){
            throw new UnexpectedValueException('locationId is required');
        }

		if(empty($this->field)){
            throw new UnexpectedValueException('field is required');
        }

        // if all validaions pass
        return true;
        
	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationLockUpdateData':
				return $this->validateLocationLockUpdateData();
				break;
			
			default:
				return $this->validateLocationLockUpdateData();
				break;
			return false;
		}
    }
}