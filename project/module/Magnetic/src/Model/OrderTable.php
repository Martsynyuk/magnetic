<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Db\Sql\Sql;
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
	public function getItem($id)
	{
		$adapter = new DbAdapter([
				'driver' => 'Pdo_Mysql',
				'hostname' => 'localhost',
				'database' => 'magnetic',
				'username' => 'root',
				'password' => ''
		]);
		
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('items')
			->where(['id' => $id]);
			
		$selectString = $sql->buildSqlString($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
			
		return $results->current();		
	}
	public function saveOrder(Order $order, $item_id, $user_id, $user_name)
	{
		$data = [
			'user_id' => $user_id,
			'adress' => $order->adress,
			'created' => date('Y-m-d'),
			'item_id' => $item_id,
			'quantity' => $order->quantity,
			'username' => $user_name
		];
		
		$this->tableGateway->insert($data);
	}
	public function getOrders()
	{
		$adapter = new DbAdapter([
				'driver' => 'Pdo_Mysql',
				'hostname' => 'localhost',
				'database' => 'magnetic',
				'username' => 'root',
				'password' => ''
		]);
		
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('order')
			->join('user', 'user.id = order.user_id', ['username', 'telephone'], 'left')
			->join('items', 'items.id = order.item_id', ['name', 'price'], 'left');
			
		$selectString = $sql->buildSqlString($select);
		
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
			
		return $results;
	}
}