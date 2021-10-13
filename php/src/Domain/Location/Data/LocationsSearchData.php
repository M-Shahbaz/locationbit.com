<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationsSearchData
{
    /** @var string */
    public $q;      
        
    /** @var int */
    public $limit;      
        
    /** @var int */
    public $offset;      
        
    
    
	private function validateLocationsSearchData() 
	{
		if(empty($this->q)){
			throw new UnexpectedValueException('q is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationsSearchData':
				return $this->validateLocationsSearchData();
				break;
			
			default:
				return $this->validateLocationsSearchData();
				break;
			return false;
		}
    }
}