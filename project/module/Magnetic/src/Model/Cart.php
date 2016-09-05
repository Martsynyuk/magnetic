<?php
namespace Magnetic\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Items implements InputFilterAwareInterface
{

	public function exchangeArray(array $data)
	{

	}

	public function getArrayCopy()
	{
		return [];
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new DomainException(sprintf(
				'%s does not allow injection of an alternate input filter',
				__CLASS__
				));
	}

	public function getInputFilter()
	{
		if ($this->inputFilter) {
			return $this->inputFilter;
		}

		$inputFilter = new InputFilter();

		$this->inputFilter = $inputFilter;

		return $this->inputFilter;
	}
}