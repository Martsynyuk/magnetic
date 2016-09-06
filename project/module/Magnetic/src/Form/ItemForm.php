<?php
namespace Magnetic\Form;

use Zend\Form\Form;

class ItemForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('login');
	
		$this->add([
				'name' => 'id',
				'type' => 'hidden',
		]);
		$this->add([
				'name' => 'name',
				'type' => 'text',
				'options' => [
						'label' => 'Item name',
				],
		]);
		$this->add([
				'name' => 'description',
				'type' => 'text',
				'options' => [
						'label' => 'Description',
				],
		]);
		$this->add([
				'name' => 'price',
				'type' => 'number',
				'options' => [
						'label' => 'Price',
				],
		]);
		$this->add([
				'name' => 'quantity',
				'type' => 'number',
				'options' => [
						'label' => 'Quantity',
				],
		]);
		$this->add([
				'name' => 'date',
				'type' => 'hidden'
		]);
		$this->add([
				'name' => 'submit',
				'type' => 'submit',
				'attributes' => [
						'value' => 'Login',
						'id'    => 'submitbutton',
				],
		]);
	}
}