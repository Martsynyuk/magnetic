<?php

namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Magnetic\Model\Order;
use Magnetic\Model\OrderTable;
use Magnetic\Form\OrderForm;
use Magnetic\Core\Autorization;


class OrderController extends AbstractActionController
{
	private $auth;
	
	public function __construct(OrderTable $table)
	{
		$this->table = $table;
		$this->auth = new AuthenticationService();
	}
	public function onDispatch(MvcEvent $e)
	{
		$autorization = new Autorization();
		
		if($autorization->autorizate($this->auth, $this->params()->fromRoute('action'))) {
			return $this->redirect()->toUrl($autorization->autorizate($this->auth, $this->params()->fromRoute('action')));
		}
		$this->layout()->setVariables(['status' => $this->auth->getStorage()->read()->status]);
		return parent::onDispatch($e);
	}
	public function addAction()
	{
		if(!$this->params()->fromRoute('id')) {
			return $this->redirect()->toUrl('/');
		}
		
		$item = $this->table->getItem($this->params()->fromRoute('id'));
		
		$form = new OrderForm();
		$form->get('submit')->setValue('order');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form, 'item' => $item, 'id' => $this->params()->fromRoute('id')];
		}
		
		$order = new Order();
		$form->setInputFilter($order->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form, 'item' => $item, 'id' => $this->params()->fromRoute('id')];
		}
		
		$order->exchangeArray($form->getData());
		
		$this->table->saveOrder(
								$order, 
								$this->params()->fromRoute('id'), 
								$this->auth->getStorage()->read()->id, 
								$this->auth->getStorage()->read()->username
						);
		
		return $this->redirect()->toUrl('/');
	}
	public function orderListAction()
	{
		if($this->table->getOrders()) {
			$orders = $this->table->getOrders();
			
			return new ViewModel(['orders' => $orders]);
		}
		return new ViewModel();
	}
}