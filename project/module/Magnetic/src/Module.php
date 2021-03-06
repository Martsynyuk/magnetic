<?php
namespace Magnetic;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface
{	
	public function getConfig()
	{
		return include __DIR__ . '/../config/module.config.php';
	}
	
	public function getServiceConfig()
	{
		return [
				'factories' => [
						Model\UserTable::class => function($container) {
							$tableGateway = $container->get(Model\UserTableGateway::class);
							return new Model\UserTable($tableGateway);
						},
						Model\UserTableGateway::class => function ($container) {
							$dbAdapter = $container->get(AdapterInterface::class);
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Model\User());
							return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
						},
						Model\ItemsTable::class => function($container) {
							$tableGateway = $container->get(Model\ItemsTableGateway::class);
							return new Model\ItemsTable($tableGateway);
						},
						Model\ItemsTableGateway::class => function ($container) {
							$dbAdapter = $container->get(AdapterInterface::class);
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Model\Items());
							return new TableGateway('items', $dbAdapter, null, $resultSetPrototype);
						},
						Model\OrderTable::class => function($container) {
							$tableGateway = $container->get(Model\OrderTableGateway::class);
							return new Model\OrderTable($tableGateway);
						},
						Model\OrderTableGateway::class => function ($container) {
							$dbAdapter = $container->get(AdapterInterface::class);
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Model\Order());
							return new TableGateway('order', $dbAdapter, null, $resultSetPrototype);
						},
				],
		];
	}
	
	public function getControllerConfig()
	{
		return [
				'factories' => [
						Controller\UserController::class => function($container) {
							return new Controller\UserController(
									$container->get(Model\UserTable::class)
									);
						},
						Controller\ItemsController::class => function($container) {
							return new Controller\ItemsController(
									$container->get(Model\ItemsTable::class)
									);
						},
						Controller\OrderController::class => function($container) {
							return new Controller\OrderController(
									$container->get(Model\OrderTable::class)
									);
						},
				],
		];
	}
}