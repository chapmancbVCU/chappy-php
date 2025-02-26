<?php
namespace Console\Commands;
 
use Console\Helpers\View;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Generates a new layout.
 */
class MakeLayoutCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:layout')
            ->setDescription('Generates a new layout')
            ->setHelp('php console make:layout <layout_name')
            ->addArgument('layout-name', InputArgument::REQUIRED, 'Pass the name of the new layout');
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
        return View::makeLayout($input);
    }
}
