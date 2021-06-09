<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplateDeleteData
{
    /** @var int */
    public $id;      
    
    /** @var int */
    public $deletedBy;      
    
    
	private function validate_DomainTemplateDeleteData() 
	{
		if(empty($this->id)){
			throw new UnexpectedValueException('id is required');
		}

		if(empty($this->deletedBy)){
			throw new UnexpectedValueException('deletedBy is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplateDeleteData':
				return $this->validate_DomainTemplateDeleteData();
				break;
			
			default:
				return $this->validate_DomainTemplateDeleteData();
				break;
			return false;
		}
    }
}