<?php
namespace Console\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Performs the command for serving user guide locally: 
 * 
 * bundle exec jekyll serve
 */
class ServeUserGuideCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('serve:docs')
            ->setDescription('Serves user guide locally')
            ->setHelp('run php console serve:docs to serve user guide locally');
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
        // Change to the `docs` directory and serve the Jekyll site
        $command = 'cd docs && bundle exec jekyll serve';
        
        // Execute command and capture output
        $process = popen($command, 'r');
        
        if (!$process) {
            $output->writeln('<error>Failed to start Jekyll server</error>');
            return Command::FAILURE;
        }

        // Stream output to console
        while (!feof($process)) {
            $line = fgets($process);
            if ($line !== false) {
                $output->writeln(trim($line));
            }
        }
        
        pclose($process);

        return Command::SUCCESS;
    }
}
