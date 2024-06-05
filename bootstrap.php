<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/src"),
    isDevMode: true,
);

$ini = parse_ini_file(__DIR__.'/../app.ini');

// configuring the database connection
$connection = DriverManager::getConnection([
    'dbname' => $ini['dbname'],
    'user' => $ini['user'],
    'password' => $ini['password'],
    'host' => $ini['host'],
    'driver' => $ini['driver'],
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);