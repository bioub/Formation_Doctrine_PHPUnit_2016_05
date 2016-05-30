<?php

require_once 'bootstrap.php';

$prenom = $argv[1];
$nom = $argv[2];

$contact = new \Paris5\Entity\Contact();
$contact->setPrenom($prenom)
        ->setNom($nom);

$em = GetEntityManager();
$em->persist($contact);
$em->flush();