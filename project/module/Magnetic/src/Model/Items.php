<?php
namespace Magnetic\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\IsFloat;
use Zend\Validator\Digits;

class Items implements InputFilterAwareInterface
{
	public $id;
	public $name;
	public $description;
	public $price;
	public $quantity;
	public $created;
	private $inputFilter;
	
	public function exchangeArray(array $data)
	{
		$this->id = !empty($data['id']) ? $data['id'] : null;
		$this->name = !empty($data['name']) ? $data['name'] : null;
		$this->description = !empty($data['description']) ? $data['description'] : null;
		$this->price = !empty($data['price']) ? $data['price'] : null;
		$this->quantity = !empty($data['quantity']) ? $data['quantity'] : null;
		$this->created = !empty($data['created']) ? $data['created'] : null;
	}
	
	public function getArrayCopy()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'price' => $this->price,
			'quantity' => $this->quantity,
			'created' => $this->created
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
		
		$inputFilter->add([
				'name' => 'name',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 3,
										'max' => 20,
								],
						],
				],
		]);
		$inputFilter->add([
				'name' => 'description',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 3,
										'max' => 100,
								],
						],
				],
		]);
		$inputFilter->add([
				'name' => 'price',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => IsFloat::class,
						],
				],
		]);
		$inputFilter->add([
				'name' => 'qantity',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => Digits::class,
						],
				],
		]);
		
		$this->inputFilter = $inputFilter;
	
		return $this->inputFilter;
	}
}