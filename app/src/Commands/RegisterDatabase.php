<?php

declare(strict_types= 1);

namespace Danilocgsilva\DbCloneCli\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Danilocgsilva\DbCloneCore\Entities\Database;
use Danilocgsilva\DbCloneCore\BootstrapFactory;

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
        $io->title("Database Registration");

        $entityManager = BootstrapFactory::getEntityManager();

        $entityManager->persist(
            new Database()
                ->setHost(
                    $io->ask("Database host")
                )
                ->setName(
                    $io->ask("Database name")
                )
                ->setPassword(
                    $io->askHidden("Database password")
                )
        );

        $entityManager->flush();

        $io->success("Database registered successfully!");
        
        return Command::SUCCESS;
    }
}
