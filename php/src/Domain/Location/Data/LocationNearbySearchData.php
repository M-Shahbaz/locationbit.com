<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationNearbySearchData
{
    /** @var float */
    public $lat;      
        
    /** @var float */
    public $lon;      
        
    /** @var string default 300m */
    public $distance;      
        
    /** @var int */
    public $limit;      
        
    /** @var int */
    public $offset;      
        
    
    
	private function validateLocationNearbySearchData() 
	{
		if(!isset($this->lat)){
			throw new UnexpectedValueException('lat is required');
		}

		if(!isset($this->lon)){
			throw new UnexpectedValueException('lon is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationNearbySearchData':
				return $this->validateLocationNearbySearchData();
				break;
			
			default:
				return $this->validateLocationNearbySearchData();
				break;
			return false;
		}
    }
}