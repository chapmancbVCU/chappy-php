<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

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
        $this->setName('tools:gen-controller')
            ->setDescription('Generates a new controller file!')
            ->setHelp('Generates a new controller file.')
            ->addArgument('controllername', InputArgument::REQUIRED, 'Pass the controller\'s name.');
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
        $ext = ".php";
        $fullPath = CONSOLE_ROOT.DS.'app'.DS.'controllers'.DS.$controllerName.'Controller'.$ext;
        $content = '<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class '.$controllerName.'Controller extends Controller {
    
}
';
        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            var_dump("File already exists");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
