<?php

namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Magnetic\Model\Cart;
use Magnetic\Form\OrderForm;
use Magnetic\Core\Autorization;
use Zend\Mvc\MvcEvent;

class CartController extends AbstractActionController
{
	private $auth;
	
	public function __construct(Table $table)
	{
		$this->table = $table;
		$this->auth = new AuthenticationService();
	}
	public function onDispatch(MvcEvent $e)
	{
		/*$autorization = new Autorization();
		
		if($autorization->autorizate($this->auth, $this->params()->fromRoute('action'))) {
			return $this->redirect()->toUrl($autorization->autorizate($this->auth, $this->params()->fromRoute('action')));
		}*/
		return parent::onDispatch($e);
	}
	public function addAction()
	{
		if(isset($_SESSION['items'])) {
			$_SESSION['items'] = $_SESSION['items'] . ', ' . $this->params()->fromRoute('id');
		} else {
			$_SESSION['items'] = $this->params()->fromRoute('id');
		}
		return $this->redirect()->toUrl('/');
	}
	public function myOrdersAction()
	{
		if(!isset($_SESSION['items'])) {
			return new ViewModel();
		}
		
		$items = $this->table->selectItems(explode(', ', $_SESSION['items']));
		return new ViewModel(['items' => $items]);
	}
	public function checkoutAction()
	{
		$form = new OrderForm();
		$form->get('submit')->setValue('order');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form, 'orders' => ''];
		}
		
		$cart = new Cart();
		$form->setInputFilter($cart->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$cart->exchangeArray($form->getData());
		// вибирати тільки чекнуті items
		$this->table->saveOrder($cart);
		return $this->redirect()->toUrl('/cart/buy');
	}
}