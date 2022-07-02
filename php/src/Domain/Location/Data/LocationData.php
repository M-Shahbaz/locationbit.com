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
    public $description;

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

    /** @var string (varchar)*/
    public $website;      
    
    /** @var string (varchar)*/
    public $email;      
    
    /** @var string (varchar)*/
    public $phone;  
    
    /** @var string (varchar)*/
    public $whatsApp;  
    
    /** @var string (varchar)*/
    public $googleMaps;  
    
    /** @var string (varchar)*/
    public $googleStreetView;  
    
    /** @var string (varchar)*/
    public $facebook;  
    
    /** @var string (varchar)*/
    public $twitter;  
    
    /** @var string (varchar)*/
    public $instagram;  
    
    /** @var string (varchar)*/
    public $youtube;  
    
    /** @var string (varchar)*/
    public $linkedin;  
    
    /** @var string (varchar)*/
    public $telegram;  
        
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

    /** @var array */
    public $similarLocations;

    /** @var array */
    public $nearbyLocations;

    /** @var array */
    public $slug;
}
