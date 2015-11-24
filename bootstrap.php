<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once 'vendor/autoload.php';

$isDevMode = true;

$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yml/"), $isDevMode);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

$em = EntityManager::create($conn, $config);

