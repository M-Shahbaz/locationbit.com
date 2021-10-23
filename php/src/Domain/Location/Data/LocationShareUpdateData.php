<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationShareUpdateData
{
    /** @var int */
    public $id;      
    
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var int */
    public $userId;      
    
    /** @var int (tinyint)*/
    public $name;      
    
    /** @var int (tinyint)*/
    public $description;      
    
    /** @var int (tinyint)*/
    public $address;      
    
    /** @var int (tinyint)*/
    public $city;      
    
    /** @var int (tinyint)*/
    public $state;      
    
    /** @var int (tinyint)*/
    public $country;      
    
    /** @var int (tinyint)*/
    public $postcode;      
    
    /** @var int (tinyint)*/
    public $latlon;      
    
    /** @var int (tinyint)*/
    public $website;      
    
    /** @var int (tinyint)*/
    public $email;      
    
    /** @var int (tinyint)*/
    public $phone;      
    
    /** @var int (tinyint)*/
    public $googleMaps;      
    
    /** @var int (tinyint)*/
    public $googleStreetView;      
    
    /** @var int (tinyint)*/
    public $facebook;      
    
    /** @var int (tinyint)*/
    public $twitter;      
    
    /** @var int (tinyint)*/
    public $instagram;      
    
    /** @var int (tinyint)*/
    public $youtube;      
    
    /** @var int (tinyint)*/
    public $linkedin;      
    
    /** @var int (tinyint)*/
    public $telegram;      
    
    /** @var int (tinyint)*/
    public $sector;      
    
    /** @var int (tinyint)*/
    public $subSector;      
    
    /** @var int (tinyint)*/
    public $industryGroup;      
    
    /** @var int (tinyint)*/
    public $naicsIndustry;      
    
    /** @var int (tinyint)*/
    public $nationalIndustry;      
    
    /** @var int (tinyint)*/
    public $hoursMondayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursMondayTo;      
    
    /** @var int (tinyint)*/
    public $hoursTuesdayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursTuesdayTo;      
    
    /** @var int (tinyint)*/
    public $hoursWednesdayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursWednesdayTo;      
    
    /** @var int (tinyint)*/
    public $hoursThursdayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursThursdayTo;      
    
    /** @var int (tinyint)*/
    public $hoursFridayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursFridayTo;      
    
    /** @var int (tinyint)*/
    public $hoursSaturdayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursSaturdayTo;      
    
    /** @var int (tinyint)*/
    public $hoursSundayFrom;      
    
    /** @var int (tinyint)*/
    public $hoursSundayTo;       
    
    /** @var int */
	public $updatedBy;      
	
	private function validateLocationShareUpdateData() 
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
			case 'validateLocationShareUpdateData':
				return $this->validateLocationShareUpdateData();
				break;
			
			default:
				return $this->validateLocationShareUpdateData();
				break;
			return false;
		}
    }
}