<?php

declare(strict_types= 1);

namespace Danilocgsilva\DbCloneCli\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name:"config:register-database")]
class RegisterDatabase
{
    public function __invoke(): int
    {
        print("This is my first command");
        return Command::SUCCESS;
    }
}
