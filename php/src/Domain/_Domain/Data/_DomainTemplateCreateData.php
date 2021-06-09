<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplateCreateData
{
    /** @var varchar */
    public $title;      
    
    /** @var int */
    public $createdBy;      
    
	private function validate_DomainTemplateCreateData() 
	{
		if(empty($this->title)){
			throw new UnexpectedValueException('title is required');
		}

		if(empty($this->createdBy)){
			throw new UnexpectedValueException('createdBy is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplateCreateData':
				return $this->validate_DomainTemplateCreateData();
				break;
			
			default:
				return $this->validate_DomainTemplateCreateData();
				break;
			return false;
		}
    }
}