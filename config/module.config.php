<?php

namespace DtlAdmin;

use Laminas\Router\Http\Literal;
use DtlAdmin\Controller\Factory\IndexControllerFactory;

return [
    'dtladmin' => [
        'use_admin_layout' => true,
        'admin_layout_template' => 'layout/admin',
        'admin_layout_template_ajax' => 'layout/admin-ajax',
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'dtl-admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/app',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'DtlAdmin' => __DIR__ . '/../view',
        ],
    ],
    'access_filter' => [
        'options' => [
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                ['actions' => [], 'allow' => '*'],
                ['actions' => ['index'], 'allow' => '@']
            ],
        ]
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Dashboard',
                'route' => 'dtl-admin',
            ],
        ],
        'admin' => [
            [
                'label' => 'Dashboard',
                'route' => 'dtl-admin',
                'class' => ' active'
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            \Laminas\Navigation\Service\NavigationAbstractServiceFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'translate' => \Laminas\I18n\View\Helper\Translate::class,
        ],
    ],
];
