<?php

require_once 'bootstrap.php';

$sm = $conn->getSchemaManager();

$dbs = $sm->listDatabases();

if (!in_array('formation_doctrine', $dbs)) {
    $sm->createDatabase('formation_doctrine');
    echo "La base a bien été créée\n";
}
else {
    echo "La base existait déjà\n";
}