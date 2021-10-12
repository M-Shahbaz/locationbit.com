<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationCitiesSearchData
{
    /** @var string */
    public $city;         
        
    /** @var int */
    public $limit;      
        
    /** @var int */
    public $offset;      
        
    
    
	private function validateLocationCitiesSearchData() 
	{
		if(empty($this->city)){
			throw new UnexpectedValueException('city is required');
		}

		if(empty($this->limit)){
			throw new UnexpectedValueException('limit is required');
		}

		if(!isset($this->offset)){
			throw new UnexpectedValueException('offset is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationCitiesSearchData':
				return $this->validateLocationCitiesSearchData();
				break;
			
			default:
				return $this->validateLocationCitiesSearchData();
				break;
			return false;
		}
    }
}