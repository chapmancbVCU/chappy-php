<?php
namespace Console\App\Commands;
 
use Core\Helper;
use Console\App\Helpers\Controller;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * Supports ability to generate new migration file.
 */
class GenerateControllerCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:controller')
            ->setDescription('Generates a new controller file!')
            ->setHelp('php console make:controller MyController, add --layout=<optional_layout_name> to set layout, and --resource to generate CRUD functions')
            ->addArgument('controllername', InputArgument::REQUIRED, 'Pass the controller\'s name.')
            ->addOption(
                'layout',
                null,
                InputOption::VALUE_OPTIONAL,
                'Layout for views associated with controller.',
                false)
            ->addOption(
                'resource',
                null,
                InputOption::VALUE_OPTIONAL,
                'Add CRUD functions',
                false
            );
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
        $controllerName = $input->getArgument('controllername');

        if (php_sapi_name() != 'cli') die('Restricted');
        $fullPath = ROOT.DS.'app'.DS.'controllers'.DS.$controllerName.'Controller.php';
        
        // Test if --layout is properly set
        $layoutInput = $input->getOption('layout');
        if($layoutInput === false) {
            $layout = 'default';
        } else if ($layoutInput === null) {
            //var_dump("Please supply name of layout");
            echo "\e[0;37;41m\n\n"."   Please supply name of layout.\n\e[0m\n";
            return Command::FAILURE;
        } else {
            if($layoutInput === '') {
                echo "\e[0;37;41m\n\n"."   Please supply name of layout.\n\e[0m\n";
                return Command::FAILURE;
            }
            $layout = $layoutInput;
        }

        // Test if --resource flag is set and generate appropriate version of file
        $resource = $input->getOption('resource');
        if($resource === false) {
            // No option
            $content = Controller::defaultTemplate($controllerName, $layout);
        } else if ($resource === null) {
            // Option with no argument
            $content = Controller::resourceTemplate($controllerName, $layout);
        } else {
            // Option with argument
            var_dump("--resource does not accept a value");
            return Command::FAILURE;
        }

        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            var_dump("File already exists");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    
}
