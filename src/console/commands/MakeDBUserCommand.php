<?php
namespace Console\App\Commands;
 
use Console\App\Helpers\Tools;
use Console\App\Helpers\Migrate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Undocumented class
 */
class MakeDBUserCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:db-user')
            ->setDescription('Create a new database user')
            ->setHelp('php console make:db-user <user_name> --password=<password> --db=<db_name> --host=<host_name> --root-password=<root_password>')
            ->addArgument('username', InputArgument::REQUIRED, 'Pass username')
            ->addOption(
                'password',
                null,
                InputOption::VALUE_REQUIRED,
                'The password for user',
                false)
            ->addOption(
                'db',
                null,
                InputOption::VALUE_REQUIRED,
                'Database for user',
                false)
            ->addOption(
                'host',
                null,
                InputOption::VALUE_OPTIONAL,
                'Host were database is located',
                false)
            ->addOption(
                'root-password',
                null,
                InputOption::VALUE_OPTIONAL,
                'The password for root',
                false);
        
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
        // Handle username with password
        $user = $input->getArgument('username');

        // Get required password input
        $password = $input->getOption('password');
        if($password === false) {
            Tools::info('Please supply a password', 'red');
            return Command::FAILURE;
        } else if ($password === null) {
            Tools::info('Please supply a password', 'red');
            return Command::FAILURE;
        }

        // Get required database name input
        $dbName = $input->getOption('db');
        if($dbName === false) {
            Tools::info('Please supply a name for the database', 'red');
            return Command::FAILURE;
        } else if ($dbName === null) {
            Tools::info('Please supply a name for the database', 'red');
            return Command::FAILURE;
        }

        // Grant all on db to user and flush privileges
        // return Migrate::createUser(DB_HOST, $user, $dbName, DB_PASSWORD);
        return Command::SUCCESS;
    }
}
