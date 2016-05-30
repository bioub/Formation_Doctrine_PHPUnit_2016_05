<?php

require_once 'vendor/autoload.php';

$connParams = [
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'mysqli'
];

$conn = \Doctrine\DBAL\DriverManager::getConnection($connParams);
