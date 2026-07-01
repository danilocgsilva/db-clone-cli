<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../vendor/danilocgsilva/db-clone-core/src/Entities/'],
    isDevMode: true
);
$config->enableNativeLazyObjects(true);

$connection = DriverManager::getConnection([
    'driver'   => 'pdo_mysql',
    'host'     => getenv('DB_HOST'),
    'port'     => getenv('DB_PORT') ?: 3306,
    'user'     => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'dbname'   => getenv('DB_NAME'),
]);

$entityManager = new EntityManager($connection, $config);
