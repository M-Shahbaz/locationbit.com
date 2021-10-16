<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationTicketCreateData
{
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var int */
    public $userId;      
    
    /** @var string (varchar)*/
    public $field;      
    
    /** @var int (tinyint) null=add, 1=update, 2=delete, 3=negative tickets */
    public $status;      
    
    /** @var int */
    public $tickets;      
    
    /** @var int */
    public $createdBy;      
    
	private function validateLocationTicketCreateData() 
	{
		if(empty($this->locationId)){
			throw new UnexpectedValueException('locationId is required');
		}

		if(empty($this->userId)){
			throw new UnexpectedValueException('userId is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationTicketCreateData':
				return $this->validateLocationTicketCreateData();
				break;
			
			default:
				return $this->validateLocationTicketCreateData();
				break;
			return false;
		}
    }
}