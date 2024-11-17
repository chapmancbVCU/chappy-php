<?php
namespace Console\App\Commands;
use Core\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Helpers\Migrate;
/**
 * Supports ability to run a migration file.
 */
class RunMigrationCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('migrate')
            ->setDescription('Runs a Database Migration!')
            ->setHelp('Runs a Database Migration');
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
        return Migrate::migrate($input, $output);
    }
}
