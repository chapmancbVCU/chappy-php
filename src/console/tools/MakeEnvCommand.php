<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
 
/**
 * Supports ability to copy .env.sample file and name it 
 * .env.
 */
class MakeEnvCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('tools:mk-env')
            ->setDescription('Creates the .env file')
            ->setHelp('php console mk-env to create .env file');
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
        $filesystem = new Filesystem();
        $filesystem->copy(CONSOLE_ROOT . DS . '.env.sample', CONSOLE_ROOT . DS . 'test.txt');
        return Command::SUCCESS;
    }
    
}