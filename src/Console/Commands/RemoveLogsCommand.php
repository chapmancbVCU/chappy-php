<?php
namespace Console\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Helpers\Tools;

/**
 * Supports ability to delete log file.
 */
class RemoveLogsCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('log:clear')
            ->setDescription('Removes log file')
            ->setHelp('Run php console log:clear to remove log files.');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input The input.
     * @param OutputInterface $output The output.
     * @return int A value that indicates success, invalid, or failure.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // When successful
        if(unlink(ROOT.DS.'storage'.DS.'logs'.DS.'app.log')) {
            Tools::info('Log file successfully cleared', 'green');
            return COMMAND::SUCCESS;
        } 

        // Always execute when there is a failure.
        Tools::info('There was an issue removing the log file', 'red');
        return COMMAND::FAILURE;
    }
}
