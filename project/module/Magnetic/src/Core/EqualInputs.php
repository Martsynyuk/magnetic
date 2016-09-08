<?php
namespace Magnetic\Core;

use Zend\Validator\AbstractValidator;

class EqualInputs extends AbstractValidator
{
	const NOT_EQUAL = 'stringsNotEqual';

	protected $contextKey;
	protected $messageTemplates = [
			self::NOT_EQUAL => 'strings not equal'
	];
	
	public function isValid($value, $context = null) 
	{
		$this->contextKey = 'password';
		$value = (string) $value;
	
		if (is_array($context)) {
			if (isset($context[$this->contextKey]) && ($value === $context[$this->contextKey])) {
				return true;
			}
		}
		else if (is_string($context) && ($value === $context))  {
			return true;
		}
		
		$this->error(self::NOT_EQUAL);
	
		return false;
	}
}