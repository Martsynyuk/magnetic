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
	public function getRecords($condition = [])
	{
		$result = $this->tableGateway->select($condition);
		return $result->current();
	}
	public function saveItems(Items $items, $id = null)
	{	var_dump($id);
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
		
	}
}