<?php

namespace App\Domain\_Domain\Data;

use UnexpectedValueException;

final class _DomainTemplateConfirmData
{
    /** @var int */
    public $id;      
    
    /** @var int */
    public $uid;      
    
    
	private function validate_DomainTemplateConfirmData() 
	{
		if(empty($this->id)){
			throw new UnexpectedValueException('id is required');
		}

		if(empty($this->uid)){
			throw new UnexpectedValueException('uid is required');
		}

		// if all validaions pass
        return true;

	}

    public function validate(string $type = null)
    {
		switch ($type) {
			case 'validate_DomainTemplateConfirmData':
				return $this->validate_DomainTemplateConfirmData();
				break;
			
			default:
				return $this->validate_DomainTemplateConfirmData();
				break;
			return false;
		}
    }
}