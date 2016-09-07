<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Magnetic\Model\User;

class UserTable
{
	private $tableGateway;

	public function __construct(TableGatewayInterface $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	public function fetchAll()
	{
		return $this->tableGateway->select();
	}
	public function saveUser(User $user)
	{
		$data = [
				'username' => $user->username,
				'password'  => md5($user->password),
				'email' => $user->email,
				'telephone' => $user->telephone,
				'user_ip' => $_SERVER['REMOTE_ADDR'],
				'status' => 'user'
		];

		$this->tableGateway->insert($data);
	}
	
	public function getUser(User $user)
	{
		$data = [
				'username' => $user->username,
				'password'  => md5($user->password)
		];
		
		$rowset = $this->tableGateway->select($data);
		$row = $rowset->current();
		
		return $row;
	}
}