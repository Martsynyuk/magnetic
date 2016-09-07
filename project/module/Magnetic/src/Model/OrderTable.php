<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Magnetic\Model\Order;

class OrderTable
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
	public function getItem()
	{

	}
	public function setOrder($data)
	{

	}
}