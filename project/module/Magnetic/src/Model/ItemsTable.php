<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Magnetic\Model\Items;

class UserTable
{
	private $tableGateway;

	public function __construct(TableGatewayInterface $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	public function getRecords()
	{
		
	}
	public function saveItems($data, $id = null)
	{
		
	}
	public function deleteItems($items_id)
	{
		
	}
}