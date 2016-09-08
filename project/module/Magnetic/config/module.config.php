<?php
namespace Magnetic;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
		'router' => [
			'routes' => [
				'home' => [
						'type' => Literal::class,
						'options' => [
									'route'    => '/',
									'defaults' => [
												'controller' => Controller\ItemsController::class,
												'action'     => 'index',
									],
						],
				],
				'user' => [
						'type'    => Segment::class,
						'options' => [
									'route' => '/user[/:action[/:id]]',
									'constraints' => [
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										],
									'defaults' => [
												'controller' => Controller\UserController::class,
												'action'     => 'login',
								],
							],
				],
				'items' => [
						'type'    => Segment::class,
						'options' => [
								'route' => '/items[/:action[/:page]]',
								'constraints' => [
										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
										'id'     => '[0-9]+',
								],
								'defaults' => [
										'controller' => Controller\ItemsController::class,
										'action'     => 'index',
								],
						],
				],
				'order' => [
						'type'    => Segment::class,
						'options' => [
								'route' => '/order[/:action[/:id]]',
								'constraints' => [
										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
										'id'     => '[0-9]+',
								],
								'defaults' => [
										'controller' => Controller\OrderController::class,
										'action'     => 'orderList',
								],
						],
				],
			],
		],
		
		
		'view_manager' => [
				'template_map' => [
						'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml'
				],
				'template_path_stack' => [
						'user' => __DIR__ . '/../view',
						'items' => __DIR__ . '/../view',
						'order' => __DIR__ . '/../view'
				],
		],
];
