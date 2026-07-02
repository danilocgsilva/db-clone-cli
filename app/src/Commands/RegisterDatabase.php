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

        BootstrapFactory::getEntityManager()
            ->persist(
                new Database()
                    ->setHost(
                        $io->ask("Database host")
                    )
                    ->setPassword(
                        $io->ask("Database password")
                    )
                    ->setName(
                        $io->askHidden("Database name")
                    )
            )
            ->flush();


        // $databaseHost = $io->ask("Database host");
        // $databaseUser = $io->ask("Database user");
        // $databasePassword = $io->askHidden("Database user");



        // $io->text("The database host is {$databaseHost}");
        // $io->text("The database user is {$databaseUser}");
        // $io->text("The database password is {$databasePassword}");

        $io->success("Database registered successfully!");
        
        return Command::SUCCESS;
    }
}
