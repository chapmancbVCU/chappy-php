<?php
namespace Console\App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Helpers\Migrate;

/**
 * Supports ability to drop all tables.
 */
class DropTablesCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('migrate:drop-all')
            ->setDescription('Drops all database tables')
            ->setHelp('Drops all database tables');
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
        return Migrate::dropAllTables();
    }
}
