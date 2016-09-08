<?php
namespace Magnetic\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Magnetic\Model\Items;

class ItemsTable
{
	private $tableGateway;

	public function __construct(TableGatewayInterface $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	public function fetchAll($paginated = false)
	{
		if ($paginated) {
			return $this->PaginatedResults();
		}
		
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
	private function PaginatedResults()
	{
		$select = new Select($this->tableGateway->getTable());
	
		$result = new ResultSet();
		$result->setArrayObjectPrototype(new Items());
	
		$paginator = new DbSelect(
				$select,
				$this->tableGateway->getAdapter(),
				$result
				);
	
		$paginator = new Paginator($paginator);
		
		return $paginator;
	}
}