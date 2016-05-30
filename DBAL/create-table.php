<?php

require_once 'bootstrap.php';

$table = new \Doctrine\DBAL\Schema\Table('contact');
$table->addColumn('id', 'integer', ['autoincrement' => true]);
$table->addColumn('prenom', 'string', ['length' => 40]);
$table->addColumn('nom', 'string', ['length' => 40]);
$table->setPrimaryKey(['id']);

$conn->exec('USE formation_doctrine');

$tableNames = $conn->getSchemaManager()->listTableNames();
// $tables = $conn->getSchemaManager()->listTables();

$sm = $conn->getSchemaManager();

if (!in_array('contact', $tableNames)) {
    $sqlCreate = $sm->getDatabasePlatform()->getCreateTableSQL($table);
    echo "$sqlCreate[0]\n";

    $sm->createTable($table);
}
else {
    $newSchema = new \Doctrine\DBAL\Schema\Schema([$table]);
    //$oldSchema = new \Doctrine\DBAL\Schema\Schema($sm->listTables());
    $oldSchema = $sm->createSchema();

    $comp = new \Doctrine\DBAL\Schema\Comparator();
    $diff = $comp->compare($oldSchema, $newSchema);

    $sqlDiff = $diff->toSaveSql($conn->getDatabasePlatform());

    foreach($sqlDiff as $sql) {
        echo "$sql\n";
        $conn->exec($sql);
    }


}