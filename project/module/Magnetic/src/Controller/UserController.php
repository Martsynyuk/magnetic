<?php
namespace Magnetic\Controller;

use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;
use Magnetic\Model\UserTable;
use Magnetic\Form\LoginForm;
use Magnetic\Form\RegistrationForm;
use Magnetic\Model\User;
use Magnetic\Core\Autorization;
use Zend\Mvc\MvcEvent;

class UserController extends AbstractActionController
{
	private $table;
	private $auth;
	
	public function __construct(UserTable $table)
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
		if($this->auth->getStorage()->read()) {
			$this->layout()->setVariables(['status' => $this->auth->getStorage()->read()->status]);
		}
		return parent::onDispatch($e);
	}
	public function loginAction()
	{
		$form = new LoginForm();
		$form->get('submit')->setValue('Login');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form];
		}
		
		$user = new User();
		$form->setInputFilter($user->getInputFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$user->exchangeArray($form->getData());

		$dbAdapter = new DbAdapter([
				'driver' => 'Pdo_Mysql',
				'hostname' => 'localhost',
				'database' => 'magnetic',
				'username' => 'root',
				'password' => ''
		]);
		
		$authAdapter = new AuthAdapter($dbAdapter,
				'user',
				'username',
				'password',
				'MD5(?)'
				);
		
		$authAdapter
		->setIdentity($user->username)
		->setCredential($user->password);
		
		$result = $this->auth->authenticate($authAdapter);
		
		if ($result->isValid()) {
			
			$storage = $this->auth->getStorage();
			$storage->write($authAdapter->getResultRowObject());
			
			return $this->redirect()->toUrl('/');
		}
	}
	
	public function registrationAction()
	{
		$form = new RegistrationForm();
		$form->get('submit')->setValue('registration');
		
		$request = $this->getRequest();
		
		if (! $request->isPost()) {
			return ['form' => $form];
		}
		
		$user = new User();
		$form->setInputFilter($user->getRegistrationFilter());
		$form->setData($request->getPost());
		
		if (! $form->isValid()) {
			return ['form' => $form];
		}
		
		$user->exchangeArray($form->getData());
		
		$this->table->saveUser($user);
		return $this->redirect()->toUrl('/user/login');
	}
	public function userListAction()
	{
		if($this->table->fetchAll()) {
			$users = $this->table->fetchAll();
			return new ViewModel(['users' => $users]);
		}
		return new ViewModel();
	}
}