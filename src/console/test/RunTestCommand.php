<?php
namespace Console\App\Commands;
 
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
            ->setHelp('php console test:mk-test <test_file_name>')
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
        $filePath = 'tests'.DS.$testName.'.php';
        $command = 'php vendor/bin/phpunit '.$filePath;
        $output->writeln(sprintf($command));
        $output->writeln(shell_exec($command));
        return Command::SUCCESS;
    }
}
