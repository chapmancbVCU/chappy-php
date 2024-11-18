<?php
namespace Console\App\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Helpers\Migrate;
/**
 * Supports ability to run a migration file.
 */
class MigrateRefreshCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('migrate:refresh')
            ->setDescription('Drops all tables and runs a Database Migration!')
            ->setHelp('Drops all tables and runs a Database Migration');
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
        $status = Migrate::dropAllTables();
        if($status == Command::FAILURE) {
            return $status;
        }
        return Migrate::migrate();
    }
}