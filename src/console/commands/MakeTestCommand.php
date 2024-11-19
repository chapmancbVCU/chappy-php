<?php
namespace Console\App\Commands;
 
use Console\App\Helpers\Test;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Supports ability to generate new test file.
 */
class MakeTestCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:test')
            ->setDescription('Generates a new test file!')
            ->setHelp('php console make:test <test_name>')
            ->addArgument('testname', InputArgument::REQUIRED, 'Pass the test\'s name.');
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
        if (php_sapi_name() != 'cli') die('Restricted');
        $ext = ".php";
        $fullPath = ROOT.DS.'tests'.DS.$testName.$ext;
        $content = Test::makeTest($testName);
        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            var_dump("File already exists");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
