<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Supports ability to generate new migration file.
 */
class GenerateMigrationCommand extends Command
{
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:migration')
            ->setDescription('Generates a Database Migration!')
            ->setHelp('Generates a new Database Migration')
            ->addArgument('table_name', InputArgument::REQUIRED, 'Pass the table\'s name.');
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
        $tableName = $input->getArgument('table_name');
        if (php_sapi_name() != 'cli') die('Restricted');
        $fileName = "Migration".time();
        $ext = ".php";
        $fullPath = ROOT.DS.'migrations'.DS.$fileName.$ext;
        $content = '<?php
namespace Migrations;
use Core\Migration;

class '.$fileName.' extends Migration {
    public function up() {
        $table = \''.$tableName.'\';
        $this->createTable($table);
    }

    public function down() {
        $table = \''.$tableName.'\';
        $this->dropTable($table);
    }
}
';
        $resp = file_put_contents($fullPath, $content);

        return Command::SUCCESS;
    }
}
