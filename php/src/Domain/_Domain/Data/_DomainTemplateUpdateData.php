<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplateUpdateData
{
    /** @var int */
    public $id;      
    
    /** @var varchar */
    public $title;         
    
    /** @var int */
	public $updatedBy;      
	
	private function validate_DomainTemplateUpdateData() 
	{
		if(empty($this->id)){
            throw new UnexpectedValueException('id is required');
        }

        if(empty($this->updatedBy)){
            throw new UnexpectedValueException('updatedBy is required');
        }

        // if all validaions pass
        return true;
        
	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplateUpdateData':
				return $this->validate_DomainTemplateUpdateData();
				break;
			
			default:
				return $this->validate_DomainTemplateUpdateData();
				break;
			return false;
		}
    }
}