<?php

namespace App\Domain\User\Data;

final class UserData
{
    /** @var string */
    public $id;      
    
    /** @var string (varchar)*/
    public $name;      
    
    /** @var string (varchar)*/
    public $email;      
    
    /** @var int (tinyint)*/
    public $role;      
    
    /** @var int (tinyint)*/
    public $active;      
    
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