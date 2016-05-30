<?php

require_once 'bootstrap.php';

$em = GetEntityManager();

$objects = \Nelmio\Alice\Fixtures::load(__DIR__.'/fixtures/fixtures-dev.yml', $em, ['locale' => 'fr_FR']);