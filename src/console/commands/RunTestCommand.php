<?php
namespace Console\App\Commands;
use Core\Helper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Supports ability to run a phpunit test with only the name of the test 
 * file is accepted as a required input.
 */
class RunTestCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('test:run-test')
            ->setDescription('Performs the phpunit test.')
            ->setHelp('php console test:run-test <test_file_name> without the .php extension.')
            ->addArgument('testname', InputArgument::REQUIRED, 'Pass the test file\'s name.');
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
        $testName = $input->getArgument('testname');
        $command = 'php vendor/bin/phpunit tests'.DS.$testName.'.php';
        $output->writeln(Helper::printBorder());
        $output->writeln(sprintf('Running command: '.$command));
        $output->writeln(Helper::printBorder());
        $output->writeln(shell_exec($command));
        $output->writeln(Helper::printBorder());
        return Command::SUCCESS;
    }
}
