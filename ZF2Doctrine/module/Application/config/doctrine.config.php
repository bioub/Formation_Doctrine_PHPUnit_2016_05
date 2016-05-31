<?php

return [
    'doctrine' => [
        // Metadata Mapping driver configuration
        'driver' => [
            'application_annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Application/Entity'
                ]
            ],
            // Configuration for service `doctrine.driver.orm_default` service
            'orm_default' => [
                // Map of driver names to be used within this driver chain, indexed by
                // entity namespace
                'drivers' => [
                    'Application\Entity' => 'application_annotation_driver'
                ]
            ]
        ],
    ]
];
