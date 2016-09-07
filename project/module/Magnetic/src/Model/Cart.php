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
	public $adress;
	public $quantity;
	private $inputFilter;
	
	public function exchangeArray(array $data)
	{
		$this->adress = !empty($data['adress']) ? $data['adress'] : null;
		$this->quantity = !empty($data['quantity']) ? $data['quantity'] : null;
	}

	public function getArrayCopy()
	{
		return [
			'adress' => $this->adress,
			'quantity' => $this->quantity
		];
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