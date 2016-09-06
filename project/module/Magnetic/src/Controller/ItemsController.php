<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Magnetic\Model\Items;
use Magnetic\Model\ItemsTable;
use Magnetic\Form\ItemForm;
use Magnetic\Core\Autorization as Autorization;
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
		return parent::onDispatch($e);
	}
	public function indexAction()
	{
		//$this->params()->fromRoute('action'); // get active action
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