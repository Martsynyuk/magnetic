<?php
namespace Magnetic\Form;

use Zend\Form\Form;

class Order extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('login');
	
		$this->add([
				'name' => 'id',
				'type' => 'hidden',
		]);
		$this->add([
				'name' => 'status',
				'type' => 'Zend\Form\Element\Select',
				'options' => [
						'label' => 'status',
						'value_options' => [
								'max' => 'max',
								'min' => 'min',
						],
				],
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