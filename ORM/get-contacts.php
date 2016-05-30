<?php

require_once 'bootstrap.php';

$em = GetEntityManager();

$repo = $em->getRepository(\Paris5\Entity\Contact::class);

$contacts = $repo->findAll();

foreach ($contacts as $contact) {
    echo $contact->getPrenom() . "\n";
}

$contacts = $repo->findBy(['prenom' => 'Toto'], ['prenom' => 'ASC']);

foreach ($contacts as $contact) {
    echo $contact->getPrenom() . "\n";
}

// Exercice :
// Entité Societe avec id, nom, codePostal, ville
// Entité Groupe avec id, nom, description
// Générer les getters/setters
// Générer les tables
// Générer un jeu de test avec nelmio/alice
