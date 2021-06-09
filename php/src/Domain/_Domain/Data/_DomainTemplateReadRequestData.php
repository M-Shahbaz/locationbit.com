<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplateReadRequestData
{
    /** @var int */
    public $jwtUserId;          
    
    /** @var int */
    public $_domainTemplateId;      
    
	private function validate_DomainTemplateReadRequestData() 
	{
		if(empty($this->jwtUserId)){
			throw new UnexpectedValueException('jwtUserId is required');
		}

		if(empty($this->_domainTemplateId)){
			throw new UnexpectedValueException('_domainTemplateId is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplateReadRequestData':
				return $this->validate_DomainTemplateReadRequestData();
				break;
			
			default:
				return $this->validate_DomainTemplateReadRequestData();
				break;
			return false;
		}
    }
}