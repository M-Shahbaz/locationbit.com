<?php

namespace App\Domain\Jwt\Data;

use UnexpectedValueException;

final class JwtUserData
{
    /** @var int */
    public $uid;      
    
    /** @var string */
    public $uname;      
    
    /** @var string */
    public $fname;      
    
    /** @var string */
    public $lname;      
    
    /** @var string */
    public $jobtitle;      
    
    /** @var string */
    public $type;      
    
    /** @var string */
    public $role;      
    
    /** @var string */
    public $is_superadmin;      
    
    /** @var string */
    public $phone_access;      
    
    /** @var string */
    public $benefy_access;      
    
    /** @var string */
    public $ssp_access;      
    
    /** @var string */
    public $bco_access;      
    
    /** @var string */
    public $subscribed_to_gsuite;      
    
    /** @var string */
    public $subscribed_to_office365;      
    
    /** @var string */
    public $office365_calendar_sync;      
    
    /** @var string */
    public $gsuite_calendar_sync;      
    
    /** @var string */
    public $color;      
    
    /** @var string */
    public $group_chat;      
    
    /** @var string */
    public $notifications;      
    
    /** @var string */
    public $resource;      
    
    /** @var string */
    public $sales_regions;      
    
    /** @var string */
    public $mobile_active;      
    
    /** @var string */
    public $iat;      
    
    /** @var string */
    public $nbf;      
    
    /** @var string */
    public $exp;
	
}