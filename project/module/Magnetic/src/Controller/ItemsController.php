<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Magnetic\Model\Items;
use Magnetic\Model\ItemsTable;
use Magnetic\Model\User;
use Magnetic\Model\UserTable;
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
	public function onDispatch(MvcEvent $e)
	{
		$autorization = new Autorization();
		
		if($autorization->autorizate($this->auth, $this->params()->fromRoute('action'))) {
			return $this->redirect()->toUrl($autorization->autorizate($this->auth, $this->params()->fromRoute('action')));
		}
		
		$this->layout()->setVariables(['status' => $this->auth->getStorage()->read()->status]);
		return parent::onDispatch($e);
	}
	public function indexAction()
	{	
		if($this->table->fetchAll(true)) {
			
			$paginator = $this->table->fetchAll(true);
			$page = (int) $this->params()->fromQuery('page', 1);
			$page = ($page < 1) ? 1 : $page;
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(2);
		
			return new ViewModel(['paginator' => $paginator]);
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
		return $this->redirect()->toUrl('/items/itemsList');
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
		return $this->redirect()->toUrl('/items/itemsList');
	}
	public function deleteAction()
	{
		if(!$this->params()->fromRoute('id')) {
			return $this->redirect()->toUrl('/');
		}
		
		$this->table->deleteItems($this->params()->fromRoute('id'));
		return $this->redirect()->toUrl('/items/itemsList');
	}
	public function logoutAction()
	{
		$this->auth->clearIdentity();
	 	return $this->redirect()->toUrl('/user/login');
	}
}