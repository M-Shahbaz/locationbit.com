<?php

namespace App\Domain\Location\Data;

use UnexpectedValueException;

final class LocationLockData
{
    /** @var int */
    public $id;      
    
    /** @var string (varchar)*/
    public $locationId;      
    
    /** @var string (varchar)*/
    public $field;      
    
    /** @var string (datetime)*/
    public $lockOn;      
    
    /** @var int (tinyint)*/
    public $disputed;      
    
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