<?php

require_once 'vendor/autoload.php';

$connParams = [
    'dbname' => 'formation_doctrine',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'mysqli',
    'charset' => 'UTF8'
];

$conn = \Doctrine\DBAL\DriverManager::getConnection($connParams);

function GetEntityManager()
{
    $conn = $GLOBALS['conn'];

    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([
        __DIR__ . '/src/Paris5/Entity'
    ]);

    return \Doctrine\ORM\EntityManager::create($conn, $config);
}