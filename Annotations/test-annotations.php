<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Paris5\Entity\Contact;
use Paris5\Validator\AnnotationValidator;

require_once __DIR__ . '/vendor/autoload.php';

AnnotationRegistry::registerAutoloadNamespace('Paris5\Annotation', __DIR__ . '/src');

$reader = new AnnotationReader();
//$cachedReader = new \Doctrine\Common\Annotations\CachedReader($reader, new RedisCache());

$validator = new AnnotationValidator($reader);
$contact = new Contact();
$contact->setPrenom('hrsjvsdhjghdkjhsgkjhfjksdhfkjdshjkdfshkjfhsjkdshjkdshjfhkjhdskjfhsdjfjkkjdshfsdkjhdksjfhsdjkkdhsf');
var_dump($validator->isValid($contact));

