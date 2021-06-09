<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplatesSearchData
{
    /** @var string */
    public $from;      
        
    /** @var string */
    public $to;      
        
    /** @var array */
    public $userIds;      
        
    /** @var int */
    public $limit;      
        
    /** @var int */
    public $offset;      
        
    
    
	private function validate_DomainTemplatesSearchData() 
	{
		if(empty($this->userIds)){
			throw new UnexpectedValueException('userIds is required');
		}

		if(empty($this->limit)){
			throw new UnexpectedValueException('limit is required');
		}

		if(!isset($this->offset)){
			throw new UnexpectedValueException('offset is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplatesSearchData':
				return $this->validate_DomainTemplatesSearchData();
				break;
			
			default:
				return $this->validate_DomainTemplatesSearchData();
				break;
			return false;
		}
    }
}