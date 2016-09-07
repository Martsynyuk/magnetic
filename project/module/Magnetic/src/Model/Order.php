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

class Order implements InputFilterAwareInterface
{
	public $user_id;
	public $created;
	public $item_id;
	public $adress;
	public $quantity;
	private $inputFilter;
	
	public function exchangeArray(array $data)
	{
		$this->adress = !empty($data['adress']) ? $data['adress'] : null;
		$this->quantity = !empty($data['quantity']) ? $data['quantity'] : null;
		$this->user_id = !empty($data['user_id']) ? $data['user_id'] : null;
		$this->created = !empty($data['created']) ? $data['created'] : null;
		$this->item_id = !empty($data['item_id']) ? $data['item_id'] : null;
	}

	public function getArrayCopy()
	{
		return [
			'adress' => $this->adress,
			'quantity' => $this->quantity,
			'user_id' => $this->user_id,
			'created' => $this->created,
			'item_id' => $this->item_id
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