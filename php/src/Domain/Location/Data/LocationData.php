<?php

namespace App\Domain\Location\Data;

final class LocationData
{
    /** @var string */
    public $id;

    /** @var int */
    public $osm_id;

    /** @var string (varchar)*/
    public $name;

    /** @var string (varchar)*/
    public $address;

    /** @var string (varchar)*/
    public $postcode;

    /** @var string (char)*/
    public $countrycode;

    /** @var string (char) en*/
    public $country;

    /** @var string (char)*/
    public $countryDefault;

    /** @var string (varchar)*/
    public $state;

    /** @var string (varchar)*/
    public $stateCode;

    /** @var string (varchar)*/
    public $stateDefault;

    /** @var string (varchar)*/
    public $city;

    /** @var string (varchar)*/
    public $cityDefault;

    /** @var float (decimal)*/
    public $lat;

    /** @var float (decimal)*/
    public $lon;

    /** @var string */
    public $object_type;

    /** @var string */
    public $osm_type;

    /** @var string */
    public $osm_key;

    /** @var string */
    public $osm_value;

    /** @var int */
    public $createdBy;

    /** @var int */
    public $importance;

    /** @var string (datetime)*/
    public $createdOn;

    /** @var int */
    public $deletedBy;

    /** @var string (datetime)*/
    public $deletedOn;

    /** @var int */
    public $updatedBy;

    /** @var string (datetime)*/
    public $updatedOn;
}
