<?php

declare(strict_types=1);

use Symfony\Component\Console\Application;
use Danilocgsilva\DbCloneCli\Commands\RegisterDatabase;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\Migrations\Tools\Console\Command as MigrationsCommand;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Danilocgsilva\DbCloneCore\BootstrapFactory;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();
$entityManager = BootstrapFactory::getEntityManager();
ConsoleRunner::addCommands($application, new SingleManagerProvider($entityManager));

$dependencyFactory = DependencyFactory::fromEntityManager(
    new PhpFile(__DIR__ . '/vendor/danilocgsilva/db-clone-core/configurations/migrations.php'),
    new ExistingEntityManager($entityManager)
);

$application->addCommands([
    new RegisterDatabase(),
    new MigrationsCommand\DumpSchemaCommand($dependencyFactory),
    new MigrationsCommand\ExecuteCommand($dependencyFactory),
    new MigrationsCommand\GenerateCommand($dependencyFactory),
    new MigrationsCommand\LatestCommand($dependencyFactory),
    new MigrationsCommand\ListCommand($dependencyFactory),
    new MigrationsCommand\MigrateCommand($dependencyFactory),
    new MigrationsCommand\RollupCommand($dependencyFactory),
    new MigrationsCommand\StatusCommand($dependencyFactory),
    new MigrationsCommand\SyncMetadataCommand($dependencyFactory),
    new MigrationsCommand\VersionCommand($dependencyFactory),
]);

$application->run();
