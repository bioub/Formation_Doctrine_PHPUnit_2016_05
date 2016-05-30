<?php

require_once 'bootstrap.php';

$conn->exec('USE formation_doctrine');

$prenom = $argv[1];
$nom = $argv[2];

$conn->insert('contact', [
    'prenom' => $prenom,
    'nom' => $nom,
]);

