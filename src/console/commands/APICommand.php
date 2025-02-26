<?php
namespace Console\Commands;
 
use Console\App\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Performs the command for generating api-docs: 
 * 
 * php doctum.phar update doctum.php
 */
class APICommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:api')
            ->setDescription('Generates or updates api-docs')
            ->setHelp('run php console make:api to generate or update api-docs');
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
        shell_exec('php doctum.phar update doctum.php');
        Tools::info('Doctum api-docs generated');
        return Command::SUCCESS;
    }
}
