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
	public function fetchAll()
	{
		return $this->tableGateway->select();
	}
	public function getRecords($condition = [])
	{
		return $this->tableGateway->select($condition)->current();
	}
	public function saveItems(Items $items, $id = null)
	{
		$data = [
			'name' => $items->name,
			'description' => $items->description,
			'price' => $items->price,
			'quantity' => $items->quantity,
			'created' => date('Y-m-d')
		];
		
		if(!$id) {
			return $this->tableGateway->insert($data);
		}
		
		if($this->getRecords($id)) {
			unset($data['created']);
			$this->tableGateway->update($data, ['id' => $id]);
		}
	}
	public function deleteItems($items_id)
	{
		$this->tableGateway->delete(['id' => (int)$items_id]);
	}
}