<?php

return [
    'doctrine' => [
        'connection' => array(
            // Configuration for service `doctrine.connection.orm_default` service
            'orm_default' => array(
                // connection parameters, see
                // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'formation_doctrine',
                    'charset'  => 'UTF8'
                )
            ),
        ),

        'configuration' => array(
            // Configuration for service `doctrine.configuration.orm_default` service
            'orm_default' => array(
                // metadata cache instance to use. The retrieved service name will
                // be `doctrine.cache.$thisSetting`
                'metadata_cache'    => 'array',

                // DQL queries parsing cache instance to use. The retrieved service
                // name will be `doctrine.cache.$thisSetting`
                'query_cache'       => 'array',
            )
        ),

        'migrations_configuration' => array(
            'orm_default' => array(
                'directory' => __DIR__ . '/../../data/migrations',
                'name' => 'Migrations',
                'namespace' => 'Migrations',
                'table' => 'migrations_table',
                'column' => 'version',
            ),
        ),
    ],
    'service_manager' => [
        'factories' => [
            'doctrine.cache.memcached' => \Application\Factory\DoctrineCacheMemcachedFactory::class
        ]
    ]
];