<?php
namespace Console\App\Commands;
 
use Console\App\Helpers\Migrate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Undocumented class
 */
class MakeDBCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:db')
            ->setDescription('Creates a new database')
            ->setHelp('php console make:db <db_name>')
            ->addArgument(
                'db-name', 
                InputArgument:: REQUIRED, 
                'Pass the name of the database to be created.'
            );
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input The input.
     * @param OutputInterface $output The output.
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $databaseName = $input->getArgument('db-name');
        return Migrate::createDatabase(DB_HOST, DB_USER, $databaseName, DB_PASSWORD);
    }
}
