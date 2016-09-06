<?php
namespace Magnetic\Core;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;

class Autorization extends AbstractActionController
{
	public function test()
	{
	
	}
	public function autorizationRules()
	{
		$acl = new Acl();
			
		$acl->addRole(new Role('guest'))
			->addRole(new Role('user'))
			->addRole(new Role('admin'));
	
		$acl->allow('guest', null, ['login', 'registration'])
			->allow('admin', null, ['index']);
	
		return $acl;
	}
	public function autorization($action)
	{
		if(!isset($this->auth->getStorage()->read()->status)) {
			$status = 'guest';
		} else {
			$status = $this->auth->getStorage()->read()->status;
		}
	
		$acl = $this->autorizationRules();
	
		if(!$acl->isAllowed($status, null, $action)) {
			if($status == 'guest') {
				return $this->redirect()->toUrl('/user/login');
			}
			return $this->redirect()->toUrl('/');
		}
	}
}