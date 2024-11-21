<?php
namespace Console\App\Commands;
 
use Console\App\Helpers\Model;
use Console\App\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Supports ability to generate new migration file.
 */
class GenerateModelCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:model')
            ->setDescription('Generates a new model file!')
            ->setHelp('Generates a new model file.')
            ->addArgument('modelname', InputArgument::REQUIRED, 'Pass the model\'s name.');
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
        $modelName = $input->getArgument('modelname');
        if (php_sapi_name() != 'cli') die('Restricted');
        $ext = ".php";
        $fullPath = ROOT.DS.'app'.DS.'models'.DS.$modelName.$ext;

        $content = Model::makeModel($modelName);
        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            Tools::info('Controller already exists');
            return Command::FAILURE;
        }

        Tools::info('Model created');
        return Command::SUCCESS;
    }
}
