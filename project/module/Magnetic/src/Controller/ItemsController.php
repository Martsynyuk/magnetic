<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Magnetic\Model\Items;
use Magnetic\Form\ItemForm;

class ItemsController extends AbstractActionController
{
	private $auth;
	
	public function __construct(ItemsTable $table)
	{
		$this->table = $table;
		$this->auth = new AuthenticationService();
	}
	public function indexAction()
	{
		return new ViewModel();
	}
	public function userListAction()
	{
		
	}
	public function itemsListAction()
	{
		
	}
	public function orderListAction()
	{
		
	}
	public function createAction()
	{	
		$form = new ItemForm();
		$form->get('submit')->setValue('create');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form];
		}
		
		$item = new Items();
		$form->setInputFilter($item->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$user->exchangeArray($form->getData());
		
		$this->table->saveItems($item);
		return $this->redirect()->toUrl('/items/itemsList');
	}
	public function updateAction()
	{
		$form = new ItemForm();
		$form->get('submit')->setValue('update');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form];
		}
		
		$item = new Items();
		$form->setInputFilter($item->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$user->exchangeArray($form->getData());
		
		$this->table->saveItems($item, $item_id);
		return $this->redirect()->toUrl('/items/itemsList');
	}
	public function deleteAction()
	{
		$this->table->deleteItems($item_id);
		return $this->redirect()->toUrl('/items/itemsList');
	}
	public function logoutAction()
	{
		$this->auth->clearIdentity();
	 	return $this->redirect()->toUrl('/user/login');
	}
}