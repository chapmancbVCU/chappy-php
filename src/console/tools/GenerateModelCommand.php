<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

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
        $this->setName('tools:gen-model')
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
        $content = '<?php
namespace App\Models;
use Core\Model;

/**
 * 
 */
class '.$modelName.' extends Model {

    // Fields you don\'t want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = \''.lcfirst($modelName).'\';

    // Soft delete
    // protected static $_softDelete = true;
    
    // Fields from your database

    public function afterDelete(): void {
        //
    }

    public function afterSave(): void {
        //
    }

    public function beforeDelete(): void {
        //
    }

    public function beforeSave(): void {
        //
    }

    /**
     * Performs validation for the '.$modelName.' model.
     *
     * @return void
     */
    public function validator(): void {
        //
    }
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
