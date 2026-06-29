<?php

declare(strict_types= 1);

use Symfony\Component\Console\Application;
use Danilocgsilva\DbCloneCli\Commands\RegisterDatabase;

require __DIR__ . "/vendor/autoload.php";

$application = new Application();

$application->addCommand(new RegisterDatabase());

$application->run();

