<?php

namespace Admin;

use Admin\Controller\Factory\RoleControllerFactory;
use Admin\Controller\Factory\UserControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'dashboard'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'auth' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/auth/login',
                            'defaults' => [
                                'controller' => Controller\AuthController::class,
                                'action' => 'login'
                            ]
                        ]
                    ],
                    'user' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/user[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                                'id' => '[1-9]\d*'
                            ],
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'role' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/role[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                                'id' => '[1-9]\d*'
                            ],
                            'defaults' => [
                                'controller' => Controller\RoleController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'resource' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/resource[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                                'id' => '[1-9]\d*'
                            ],
                            'defaults' => [
                                'controller' => Controller\ResourceController::class,
                                'action' => 'index'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\AuthController::class => InvokableFactory::class,
            Controller\UserController::class => UserControllerFactory::class,
            Controller\RoleController::class => RoleControllerFactory::class,
            Controller\ResourceController::class => Controller\Factory\ResourceControllerFactory::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            Service\UserService::class => Service\Factory\UserServiceFactory::class,
            Repository\UserTableGateway::class => Repository\Factory\UserTableGatewayFactory::class,
            Service\RoleService::class => Service\Factory\RoleServiceFactory::class,
            Repository\RoleTableGateway::class => Repository\Factory\RoleTableGatewayFactory::class,
            Service\ResourceService::class => Service\Factory\ResourceServiceFactory::class,
            Repository\ResourceTableGateway::class => Repository\Factory\ResourceTableGatewayFactory::class
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/admin'           => __DIR__ . '/../view/layout/admin.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];