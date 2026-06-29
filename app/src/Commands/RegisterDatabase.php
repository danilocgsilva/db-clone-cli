<?php

declare(strict_types= 1);

namespace Danilocgsilva\DbCloneCli\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: "config:register-database",
    description: "Register a database address",
    help: "Register a database address"
)]
class RegisterDatabase extends Command
{
    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Success");
        $io->text("It is working nicely!");
        
        return Command::SUCCESS;
    }
}
