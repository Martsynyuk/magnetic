<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Magnetic\Model\Items;

class ItemsTable
{
	private $tableGateway;

	public function __construct(TableGatewayInterface $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	public function getRecords()
	{
		
	}
	public function saveItems(Items $items, $id = null)
	{
		$data = [
			'items_name' => $items->name,
			'product_description' => $items->description,
			'price' => $items->price,
			'quantity' => $items->quantity,
			'created' => date('Y-m-d')
		];
		
		$this->tableGateway->insert($data);
	}
	public function deleteItems($items_id)
	{
		
	}
}