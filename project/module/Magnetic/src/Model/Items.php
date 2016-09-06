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
	public $id;
	public $name;
	public $description;
	public $price;
	public $quantity;
	private $inputFilter;
	
	public function exchangeArray(array $data)
	{
		$this->id = !empty($data['id']) ? $data['id'] : null;
		$this->name = !empty($data['name']) ? $data['name'] : null;
		$this->description = !empty($data['description']) ? $data['description'] : null;
		$this->price = !empty($data['price']) ? $data['price'] : null;
		$this->quantity = !empty($data['quantity']) ? $data['quantity'] : null;
	}
	
	public function getArrayCopy()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'price' => $this->price,
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