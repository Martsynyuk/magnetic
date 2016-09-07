<?php
namespace Magnetic\Form;

use Zend\Form\Form;

class Order extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('login');
		
		$this->add([
				'name' => 'checkbox',
				'type' => 'Zend\Form\Element\Checkbox',
				'options' => [
						'label' => 'checkbox',
						'unchecked_value' => ''
				],
		]);
		$this->add([
				'name' => 'quantity',
				'type' => 'number',
				'options' => [
						'label' => 'quantity',
				],
		]);
		$this->add([
				'name' => 'adress',
				'type' => 'text',
				'options' => [
						'label' => 'adress',
				],
		]);
		$this->add([
				'name' => 'submit',
				'type' => 'submit',
				'attributes' => [
						'value' => 'Buy',
						'id'    => 'submitbutton',
				],
		]);
	}
}