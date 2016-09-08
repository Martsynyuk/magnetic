<?php
namespace Magnetic\Core;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;

class Autorization
{
	public function autorizationRules()
	{
		$acl = new Acl();
			
		$acl->addRole(new Role('guest'))
			->addRole(new Role('user'))
			->addRole(new Role('admin'));
	
		$acl->allow('guest', null, ['login', 'registration'])
			->allow('user', null, ['index', 'add', 'logout'])
			->allow('admin', null, ['index', 'add', 'itemsList', 'create',
					'update', 'delete', 'userList', 'add', 'orderList', 'logout'
			]);
	
		return $acl;
	}
	public function autorizate($auth, $action)
	{
		if(!isset($auth->getStorage()->read()->status)) {
			$status = 'guest';
		} else {
			$status = $auth->getStorage()->read()->status;
		}
	
		$acl = $this->autorizationRules();
	
		if(!$acl->isAllowed($status, null, $action)) {
			if($status == 'guest') {
				return '/user/login';
			}
			return '/';
		}
		return false;
	}
}