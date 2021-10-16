<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationMysqlCreateData
{
	/** @var string (varchar)*/
	public $locationId;

	/** @var string (varchar)*/
	public $name;

	/** @var int */
	public $nameBy;

	/** @var string (text)*/
	public $description;

	/** @var int */
	public $descriptionBy;

	/** @var string (varchar)*/
	public $address;

	/** @var int */
	public $addressBy;

	/** @var string (varchar)*/
	public $postcode;

	/** @var int */
	public $postcodeBy;

	/** @var string (varchar)*/
	public $country;

	/** @var int */
	public $countryBy;

	/** @var string (char)*/
	public $countrycode;

	/** @var int */
	public $countrycodeBy;

	/** @var string (varchar)*/
	public $state;

	/** @var int */
	public $stateBy;

	/** @var string (varchar)*/
	public $statecode;

	/** @var int */
	public $statecodeBy;

	/** @var string (varchar)*/
	public $city;

	/** @var int */
	public $cityBy;

	/** @var float (decimal)*/
	public $lat;

	/** @var float (decimal)*/
	public $lon;

	/** @var int */
	public $latlonBy;

	/** @var string (varchar)*/
	public $website;

	/** @var int */
	public $websiteBy;

	/** @var string (varchar)*/
	public $email;

	/** @var int */
	public $emailBy;

	/** @var string (varchar)*/
	public $phone;

	/** @var int */
	public $phoneBy;

	/** @var string (varchar)*/
	public $googleMaps;

	/** @var int */
	public $googleMapsBy;

	/** @var string (varchar)*/
	public $googleStreetView;

	/** @var int */
	public $googleStreetViewBy;

	/** @var string (varchar)*/
	public $facebook;

	/** @var int */
	public $facebookBy;

	/** @var string (varchar)*/
	public $twitter;

	/** @var int */
	public $twitterBy;

	/** @var string (varchar)*/
	public $instagram;

	/** @var int */
	public $instagramBy;

	/** @var string (varchar)*/
	public $youtube;

	/** @var int */
	public $youtubeBy;

	/** @var string (varchar)*/
	public $linkedin;

	/** @var int */
	public $linkedinBy;

	/** @var string (varchar)*/
	public $telegram;

	/** @var int */
	public $telegramBy;

	/** @var string (varchar)*/
	public $sector;

	/** @var int */
	public $sectorBy;

	/** @var string (varchar)*/
	public $subSector;

	/** @var int */
	public $subSectorBy;

	/** @var string (varchar)*/
	public $industryGroup;

	/** @var int */
	public $industryGroupBy;

	/** @var string (varchar)*/
	public $naicsIndustry;

	/** @var int */
	public $naicsIndustryBy;

	/** @var string (varchar)*/
	public $nationalIndustry;

	/** @var int */
	public $nationalIndustryBy;

	/** @var time */
	public $hoursMondayFrom;

	/** @var int */
	public $hoursMondayFromBy;

	/** @var time */
	public $hoursMondayTo;

	/** @var int */
	public $hoursMondayToBy;

	/** @var time */
	public $hoursTuesdayFrom;

	/** @var int */
	public $hoursTuesdayFromBy;

	/** @var time */
	public $hoursTuesdayTo;

	/** @var int */
	public $hoursTuesdayToBy;

	/** @var time */
	public $hoursWednesdayFrom;

	/** @var int */
	public $hoursWednesdayFromBy;

	/** @var time */
	public $hoursWednesdayTo;

	/** @var int */
	public $hoursWednesdayToBy;

	/** @var time */
	public $hoursThursdayFrom;

	/** @var int */
	public $hoursThursdayFromBy;

	/** @var time */
	public $hoursThursdayTo;

	/** @var int */
	public $hoursThursdayToBy;

	/** @var time */
	public $hoursFridayFrom;

	/** @var int */
	public $hoursFridayFromBy;

	/** @var time */
	public $hoursFridayTo;

	/** @var int */
	public $hoursFridayToBy;

	/** @var time */
	public $hoursSaturdayFrom;

	/** @var int */
	public $hoursSaturdayFromBy;

	/** @var time */
	public $hoursSaturdayTo;

	/** @var int */
	public $hoursSaturdayToBy;

	/** @var time */
	public $hoursSundayFrom;

	/** @var int */
	public $hoursSundayFromBy;

	/** @var time */
	public $hoursSundayTo;

	/** @var int */
	public $hoursSundayToBy;

	/** @var int */
	public $createdBy;

	private function validateLocationMysqlCreateData()
	{
		if (empty($this->locationId)) {
			throw new UnexpectedValueException('locationId is required');
		}
		
		// if all validaions pass
		return true;
	}

	public function validate(string $type = null)
	{
		switch ($type) {
			case 'validateLocationMysqlCreateData':
				return $this->validateLocationMysqlCreateData();
				break;

			default:
				return $this->validateLocationMysqlCreateData();
				break;
				return false;
		}
	}
}
