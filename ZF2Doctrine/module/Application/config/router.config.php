<?php

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Contact',
                        'action' => 'list',
                    ],
                ],
            ],
            'add' => [
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => [
                    'route' => '/add',
                    'defaults' => [
                        'controller' => 'Application\Controller\Contact',
                        'action' => 'add',
                    ],
                ],
            ],
        ],
    ],
];
