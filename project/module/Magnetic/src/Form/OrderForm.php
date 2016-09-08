<?php
namespace Magnetic\Form;

use Zend\Form\Form;

class OrderForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('login');
	
		$this->add([
				'name' => 'id',
				'type' => 'hidden',
		]);
		$this->add([
				'name' => 'adress',
				'type' => 'text',
				'options' => [
						'label' => 'adress',
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