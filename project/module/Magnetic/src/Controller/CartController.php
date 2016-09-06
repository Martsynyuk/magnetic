<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Magnetic\Model\Cart;
use Magnetic\Form\OrderForm;

class CartController extends AbstractActionController
{
	private $auth;
	
	public function __construct(/*Table $table*/)
	{
		//$this->table = $table;
		$this->auth = new AuthenticationService();
	}
	public function addAction()
	{

	}
	public function myOrdersAction()
	{
	
	}
	public function checkoutAction()
	{
		
	}
}