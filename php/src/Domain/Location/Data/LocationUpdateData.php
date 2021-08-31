<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationUpdateData
{
    /** @var string */
    public $id;      
    
    /** @var string (varchar)*/
    public $postcode;      
    
    /** @var float (decimal)*/
    public $lat;      
    
    /** @var float (decimal)*/
    public $lon;      
    
    /** @var string (varchar)*/
    public $website;      
    
    /** @var string (varchar)*/
    public $email;      
    
    /** @var string (varchar)*/
    public $phone;      
    
    /** @var string (varchar)*/
    public $description;
    
    /** @var int */
	public $sector;      
    
    /** @var int */
	public $subSector;      
    
    /** @var int */
	public $industryGroup;      
    
    /** @var int */
	public $naicsIndustry;      
    
    /** @var int */
	public $nationalIndustry;      
        
    /** @var array */
	public $hours;
    
    /** @var int */
	public $updatedBy;      
	
	private function validateLocationUpdateData() 
	{
		if(empty($this->id)){
            throw new UnexpectedValueException('id is required');
        }

        if(empty($this->updatedBy)){
            throw new UnexpectedValueException('updatedBy is required');
        }

        // if all validaions pass
        return true;
        
	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validateLocationUpdateData':
				return $this->validateLocationUpdateData();
				break;
			
			default:
				return $this->validateLocationUpdateData();
				break;
			return false;
		}
    }
}