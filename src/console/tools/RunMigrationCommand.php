<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Supports ability to run a migration file.
 */
class RunMigrationCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('tools:run-migration')
            ->setDescription('Runs a Database Migration!')
            ->setHelp('Runs a Database Migration');
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
        if (php_sapi_name() != 'cli') die('Restricted');
        $fileName = "Migration".time();
        $ext = ".php";
        $fullPath = CONSOLE_ROOT.DS.'migrations'.DS.$fileName.$ext;
        $content = '<?php
namespace Migrations;
use Core\Migration;

class '.$fileName.' extends Migration {
    public function up() {

    }
}
';
        $resp = file_put_contents($fullPath, $content);

        return Command::SUCCESS;
    }
}
