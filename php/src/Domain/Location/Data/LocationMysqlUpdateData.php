<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationMysqlUpdateData
{
    /** @var int */
    public $id;      
    
	/** @var string (varchar)*/
	public $locationId;

	/** @var string (varchar)*/
	public $name;

	/** @var int */
	public $nameBy;

	/** @var string (datetime)*/
	public $nameOn;

	/** @var string (text)*/
	public $description;

	/** @var int */
	public $descriptionBy;

	/** @var string (datetime)*/
	public $descriptionOn;

	/** @var string (varchar)*/
	public $address;

	/** @var int */
	public $addressBy;

	/** @var string (datetime)*/
	public $addressOn;

	/** @var string (varchar)*/
	public $postcode;

	/** @var int */
	public $postcodeBy;

	/** @var string (datetime)*/
	public $postcodeOn;

	/** @var string (varchar)*/
	public $country;

	/** @var int */
	public $countryBy;

	/** @var string (datetime)*/
	public $countryOn;

	/** @var string (char)*/
	public $countrycode;

	/** @var int */
	public $countrycodeBy;

	/** @var string (datetime)*/
	public $countrycodeOn;

	/** @var string (varchar)*/
	public $state;

	/** @var int */
	public $stateBy;

	/** @var string (datetime)*/
	public $stateOn;

	/** @var string (varchar)*/
	public $statecode;

	/** @var int */
	public $statecodeBy;

	/** @var string (datetime)*/
	public $statecodeOn;

	/** @var string (varchar)*/
	public $city;

	/** @var int */
	public $cityBy;

	/** @var string (datetime)*/
	public $cityOn;

	/** @var float (decimal)*/
	public $lat;

	/** @var float (decimal)*/
	public $lon;

	/** @var int */
	public $latlonBy;

	/** @var string (datetime)*/
	public $latlonOn;

	/** @var string (varchar)*/
	public $website;

	/** @var int */
	public $websiteBy;

	/** @var string (datetime)*/
	public $websiteOn;

	/** @var string (varchar)*/
	public $email;

	/** @var int */
	public $emailBy;

	/** @var string (datetime)*/
	public $emailOn;

	/** @var string (varchar)*/
	public $phone;

	/** @var int */
	public $phoneBy;

	/** @var string (datetime)*/
	public $phoneOn;

	/** @var string (varchar)*/
	public $googleMaps;

	/** @var int */
	public $googleMapsBy;

	/** @var string (datetime)*/
	public $googleMapsOn;

	/** @var string (varchar)*/
	public $googleStreetView;

	/** @var int */
	public $googleStreetViewBy;

	/** @var string (datetime)*/
	public $googleStreetViewOn;

	/** @var string (varchar)*/
	public $facebook;

	/** @var int */
	public $facebookBy;

	/** @var string (datetime)*/
	public $facebookOn;

	/** @var string (varchar)*/
	public $twitter;

	/** @var int */
	public $twitterBy;

	/** @var string (datetime)*/
	public $twitterOn;

	/** @var string (varchar)*/
	public $instagram;

	/** @var int */
	public $instagramBy;

	/** @var string (datetime)*/
	public $instagramOn;

	/** @var string (varchar)*/
	public $youtube;

	/** @var int */
	public $youtubeBy;

	/** @var string (datetime)*/
	public $youtubeOn;

	/** @var string (varchar)*/
	public $linkedin;

	/** @var int */
	public $linkedinBy;

	/** @var string (datetime)*/
	public $linkedinOn;

	/** @var string (varchar)*/
	public $telegram;

	/** @var int */
	public $telegramBy;

	/** @var string (datetime)*/
	public $telegramOn;

	/** @var string (varchar)*/
	public $sector;

	/** @var int */
	public $sectorBy;

	/** @var string (datetime)*/
	public $sectorOn;

	/** @var string (varchar)*/
	public $subSector;

	/** @var int */
	public $subSectorBy;

	/** @var string (datetime)*/
	public $subSectorOn;

	/** @var string (varchar)*/
	public $industryGroup;

	/** @var int */
	public $industryGroupBy;

	/** @var string (datetime)*/
	public $industryGroupOn;

	/** @var string (varchar)*/
	public $naicsIndustry;

	/** @var int */
	public $naicsIndustryBy;

	/** @var string (datetime)*/
	public $naicsIndustryOn;

	/** @var string (varchar)*/
	public $nationalIndustry;

	/** @var int */
	public $nationalIndustryBy;

	/** @var string (datetime)*/
	public $nationalIndustryOn;

	/** @var string (time)*/
	public $hoursMondayFrom;

	/** @var int */
	public $hoursMondayFromBy;

	/** @var string (datetime)*/
	public $hoursMondayFromOn;

	/** @var string (time)*/
	public $hoursMondayTo;

	/** @var int */
	public $hoursMondayToBy;

	/** @var string (datetime)*/
	public $hoursMondayToOn;

	/** @var string (time)*/
	public $hoursTuesdayFrom;

	/** @var int */
	public $hoursTuesdayFromBy;

	/** @var string (datetime)*/
	public $hoursTuesdayFromOn;

	/** @var string (time)*/
	public $hoursTuesdayTo;

	/** @var int */
	public $hoursTuesdayToBy;

	/** @var string (datetime)*/
	public $hoursTuesdayToOn;

	/** @var string (time)*/
	public $hoursWednesdayFrom;

	/** @var int */
	public $hoursWednesdayFromBy;

	/** @var string (datetime)*/
	public $hoursWednesdayFromOn;

	/** @var string (time)*/
	public $hoursWednesdayTo;

	/** @var int */
	public $hoursWednesdayToBy;

	/** @var string (datetime)*/
	public $hoursWednesdayToOn;

	/** @var string (time)*/
	public $hoursThursdayFrom;

	/** @var int */
	public $hoursThursdayFromBy;

	/** @var string (datetime)*/
	public $hoursThursdayFromOn;

	/** @var string (time)*/
	public $hoursThursdayTo;

	/** @var int */
	public $hoursThursdayToBy;

	/** @var string (datetime)*/
	public $hoursThursdayToOn;

	/** @var string (time)*/
	public $hoursFridayFrom;

	/** @var int */
	public $hoursFridayFromBy;

	/** @var string (datetime)*/
	public $hoursFridayFromOn;

	/** @var string (time)*/
	public $hoursFridayTo;

	/** @var int */
	public $hoursFridayToBy;

	/** @var string (datetime)*/
	public $hoursFridayToOn;

	/** @var string (time)*/
	public $hoursSaturdayFrom;

	/** @var int */
	public $hoursSaturdayFromBy;

	/** @var string (datetime)*/
	public $hoursSaturdayFromOn;

	/** @var string (time)*/
	public $hoursSaturdayTo;

	/** @var int */
	public $hoursSaturdayToBy;

	/** @var string (datetime)*/
	public $hoursSaturdayToOn;

	/** @var string (time)*/
	public $hoursSundayFrom;

	/** @var int */
	public $hoursSundayFromBy;

	/** @var string (datetime)*/
	public $hoursSundayFromOn;

	/** @var string (time)*/
	public $hoursSundayTo;

	/** @var int */
	public $hoursSundayToBy;

	/** @var string (datetime)*/
	public $hoursSundayToOn;        
    
    /** @var int */
	public $updatedBy;      
	
	private function validateLocationMysqlUpdateData() 
	{
		if(empty($this->locationId)){
            throw new UnexpectedValueException('locationId is required');
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
			case 'validateLocationMysqlUpdateData':
				return $this->validateLocationMysqlUpdateData();
				break;
			
			default:
				return $this->validateLocationMysqlUpdateData();
				break;
			return false;
		}
    }
}