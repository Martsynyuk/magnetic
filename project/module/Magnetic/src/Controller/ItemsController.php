<?php
namespace Magnetic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Magnetic\Model\Items;

class ItemsController extends AbstractActionController
{
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
	public function orderItemsAction()
	{
		
	}
	public function logoutAction()
	{
		$this->auth->clearIdentity();
	 	return $this->redirect()->toUrl('/user/login');
	}
}