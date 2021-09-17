<?php

namespace App\Domain\Location\Data;

use App\Utility\PhoneService;
use Respect\Validation\Validator as v;
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

        $this->validateMaxLength(
            'postcode', 
            $this->postcode,
            50
        );

        if(!empty($this->postcode) && v::stringType()->length(null, 50)->validate($this->postcode) === false){
            throw new UnexpectedValueException('postcode max length is not valid!');
        }
        
        // https://stackoverflow.com/a/7780993/1865829
        if(isset($this->lat) && v::floatType()->between(-90, 90)->validate($this->lat) === false){
            throw new UnexpectedValueException('lat is not valid!');
        }

        if(isset($this->lon) && v::floatType()->between(-180, 180)->validate($this->lon) === false){
            throw new UnexpectedValueException('lon is not valid!');
        }

        if(!empty($this->website) && v::url()->validate($this->website) === false ){
            throw new UnexpectedValueException("{$this->website} link is not valid!");
        }
        
        $this->validateMaxLength(
            'website', 
            $this->website,
            255
        );
        
        if(!empty($this->email) && v::email()->validate($this->email) === false ){
            throw new UnexpectedValueException("{$this->email} is not valid!");
        }

        $this->validateMaxLength(
            'email', 
            $this->email,
            100
        );

        if(!empty($this->phone) && v::phone()->validate($this->phone) === false ){
            throw new UnexpectedValueException("{$this->phone} is not valid!");
        }
        
        $this->validateMaxLength(
            'phone', 
            $this->phone,
            20
        );

        $this->validateSocial(
            "Facebook", 
            $this->facebook,
            '/(?:https?:)?\/\/(?:www\.)?(?:facebook|fb)\.com\/(?P<profile>(?![A-z]+\.php)(?!marketplace|gaming|watch|me|messages|help|search|groups)[A-z0-9_\-\.]+)\/?/'
        );

        $this->validateSocial(
            "Twitter", 
            $this->twitter,
            '/(?:https?:)?\/\/(?:[A-z]+\.)?twitter\.com\/@?(?!home|share|privacy|tos)(?P<username>[A-z0-9_]+)\/?/'
        );

        $this->validateSocial(
            "Instagram", 
            $this->instagram,
            '/(?:https?:)?\/\/(?:www\.)?(?:instagram\.com|instagr\.am)\/(?P<username>[A-Za-z0-9_](?:(?:[A-Za-z0-9_]|(?:\.(?!\.))){0,28}(?:[A-Za-z0-9_]))?)/'
        );

        $this->validateSocial(
            "YouTube",
            $this->youtube,
            '/(?:https?:)?\/\/(?:[A-z]+\.)?youtube.com\/channel\/(?P<id>[A-z0-9-\_]+)\/?/'
        );

        $this->validateSocial(
            "Linkedin", 
            $this->linkedin,
            '/(?:https?:)?\/\/(?:[\w]+\.)?linkedin\.com\/(?P<company_type>(company)|(school))\/(?P<company_permalink>[A-z0-9-À-ÿ\.]+)\/?/'
        );

        $this->validateSocial(
            "Telegram", 
            $this->telegram,
            '/(?:https?:)?\/\/(?:t(?:elegram)?\.me|telegram\.org)\/(?P<username>[a-z0-9\_]{5,32})\/?/'
        );

        $this->validateMaxLength(
            'description', 
            $this->description,
            2000
        );

        $this->validateMaxLength(
            'sector', 
            $this->sector,
            10
        );

        $this->validateMaxLength(
            'subSector', 
            $this->subSector,
            10
        );

        $this->validateMaxLength(
            'industryGroup', 
            $this->industryGroup,
            10
        );

        $this->validateMaxLength(
            'naicsIndustry', 
            $this->naicsIndustry,
            10
        );

        $this->validateMaxLength(
            'nationalIndustry', 
            $this->nationalIndustry,
            10
        );

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

    public function validateSocial($social, $link, $regex){
        
        if(!empty($link) && ( v::url()->validate($link) === false || v::regex($regex)->validate($link) === false )){
            throw new UnexpectedValueException("{$social} link is not valid!");
        }
        
        if(!empty($link) && v::stringType()->length(null, 255)->validate($link) === false){
            throw new UnexpectedValueException("{$social} link max length is not valid!");
        }
        return true;
    }

    public function validateMaxLength($type, $value, $length){

        if(!empty($value) && v::stringType()->length(null, $length)->validate($value) === false){
            throw new UnexpectedValueException("{$type} max length is not valid!");
        }
        return true;
    }
    
}