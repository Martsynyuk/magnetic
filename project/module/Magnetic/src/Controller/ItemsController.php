<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Magnetic\Model\Items;
use Magnetic\Model\ItemsTable;
use Magnetic\Form\ItemForm;
use Magnetic\Core\Autorization;
use Zend\Mvc\MvcEvent;

class ItemsController extends AbstractActionController
{
	private $auth;
	
	public function __construct(ItemsTable $table)
	{
		$this->table = $table;
		$this->auth = new AuthenticationService();
	}
	public function onDispatch(MvcEvent $e) // beforeaction
	{
		//$this->params()->fromRoute('action'); // get active action
		$autorization = new Autorization();
		return parent::onDispatch($e);
	}
	public function indexAction()
	{
		if($this->table->fetchAll()) {
			$items = $this->table->fetchAll();
			return new ViewModel(['items' => $items]);
		}
		return new ViewModel();
	}
	public function userListAction()
	{
		if($this->table->fetchAll()) {
			$users = $this->table->fetchAll();
			return new ViewModel(['users' => $users]);
		}
		return new ViewModel();
	}
	public function itemsListAction()
	{
		if($this->table->fetchAll()) {
			$items = $this->table->fetchAll();
			return new ViewModel(['items' => $items]);
		}
		return new ViewModel();
	}
	public function orderListAction()
	{
		if($this->table->fetchAll()) {
			$orders = $this->table->fetchAll();
			return new ViewModel(['orders' => $orders]);
		}
		return new ViewModel();
		
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
		
		$item->exchangeArray($form->getData());
		
		$this->table->saveItems($item);
		return $this->redirect()->toUrl('/');
	}
	public function updateAction()
	{	
		$form = new ItemForm();
		$form->get('submit')->setValue('update');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			$item = $this->table->getRecords(['id' => $this->params()->fromRoute('id')]);
			if(!is_object($item)) {
				return $this->redirect()->toUrl('/');
			}
			return ['form' => $form, 'item' => $item];
		}
		
		$item = new Items();
		$form->setInputFilter($item->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$item->exchangeArray($form->getData());
		$this->table->saveItems($item, $this->params()->fromRoute('id'));
		return $this->redirect()->toUrl('/');
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