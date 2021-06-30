<?php

namespace App\Domain\Location\Data;

final class LocationData
{
    /** @var int */
    public $id;

    /** @var string (varchar)*/
    public $name;

    /** @var string (varchar)*/
    public $address;

    /** @var string (varchar)*/
    public $zipcode;

    /** @var string (char)*/
    public $country;

    /** @var string (varchar)*/
    public $state;

    /** @var string (varchar)*/
    public $city;

    /** @var float (decimal)*/
    public $latitude;

    /** @var float (decimal)*/
    public $longitude;

    /** @var int */
    public $createdBy;

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
