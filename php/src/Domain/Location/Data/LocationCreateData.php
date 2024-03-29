<?php

namespace App\Domain\Location\Data;

use App\Utility\FunctionsService;
use Respect\Validation\Validator as v;
use UnexpectedValueException;

final class LocationCreateData
{
	/** @var string (varchar)*/
	public $name;

	/** @var string (varchar)*/
	public $address;

	/** @var string (varchar)*/
	public $postcode;

	/** @var string (char)*/
	public $country;

	/** @var string (char)*/
	public $countrycode;

	/** @var string (varchar)*/
	public $state;

	/** @var string (varchar)*/
	public $statecode;

	/** @var string (varchar)*/
	public $city;

	/** @var float */
	public $lat;

	/** @var float */
	public $lon;

	/** @var array */
	public $cityObject;

	/** @var int */
	public $createdBy;

	private function validateLocationCreateData()
	{
		$this->name = FunctionsService::stripTags($this->name);
		$this->address = FunctionsService::stripTags($this->address);
		$this->postcode = FunctionsService::stripTags($this->postcode);
		$this->country = FunctionsService::stripTags($this->country);
		$this->countrycode = FunctionsService::stripTags($this->countrycode);
		$this->state = FunctionsService::stripTags($this->state);
		$this->statecode = FunctionsService::stripTags($this->statecode);
		$this->city = FunctionsService::stripTags($this->city);
		
		if (empty($this->name)) {
			throw new UnexpectedValueException('name is required');
		}

		if (empty($this->address)) {
			throw new UnexpectedValueException('address is required');
		}

		if (!isset($this->postcode)) {
			throw new UnexpectedValueException('postcode is required');
		}

		if (empty($this->countrycode)) {
			throw new UnexpectedValueException('countrycode is required');
		}

		if(!v::countryCode()->validate($this->countrycode)){
			throw new UnexpectedValueException('Not a valid countrycode!');
		}

		if (empty($this->country)) {
			throw new UnexpectedValueException('country is required');
		}

		if (empty($this->state)) {
			throw new UnexpectedValueException('state is required');
		}

		if (empty($this->statecode)) {
			throw new UnexpectedValueException('statecode is required');
		}
		
		if(!v::subdivisionCode($this->countrycode)->validate($this->statecode)){
			throw new UnexpectedValueException('Not a valid statecode!');
		}
		
		if (empty($this->city)) {
			throw new UnexpectedValueException('city is required');
		}

		if (empty($this->createdBy)) {
			throw new UnexpectedValueException('createdBy is required');
		}
		// if all validaions pass
		return true;
	}

	public function validate(string $type = null)
	{
		switch ($type) {
			case 'validateLocationCreateData':
				return $this->validateLocationCreateData();
				break;

			default:
				return $this->validateLocationCreateData();
				break;
				return false;
		}
	}
}
