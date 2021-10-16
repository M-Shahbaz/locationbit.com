<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationHistoryCreateData
{
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var string (varchar)*/
    public $table;      
    
    /** @var string (varchar)*/
    public $field;      
    
    /** @var string (varchar)*/
    public $recordId;      
    
    /** @var string (text)*/
    public $oldValue;      
    
    /** @var string (text)*/
    public $newValue;      
    
    /** @var int */
    public $oldUserId;      
    
    /** @var int */
    public $newUserId;       
    
    /** @var int */
    public $createdBy;      
    
	private function validateLocationHistoryCreateData() 
	{
		if(empty($this->locationId)){
			throw new UnexpectedValueException('locationId is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationHistoryCreateData':
				return $this->validateLocationHistoryCreateData();
				break;
			
			default:
				return $this->validateLocationHistoryCreateData();
				break;
			return false;
		}
    }
}