<?php
namespace Console\App\Commands;
use Core\DB;
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
        $this->setName('migrate')
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
        // Load configuration and helper functions
        require_once(CONSOLE_ROOT . DS . 'config' . DS . 'config.php');
        $isCli = php_sapi_name() == 'cli';
        if(!RUN_MIGRATIONS_FROM_BROWSER && !$isCli) die('restricted');

        $db = DB::getInstance();
        $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        $previousMigs = [];
        $migrationsRun = [];

        if(!empty($migrationTable)){
            $query = $db->query("SELECT migration FROM migrations")->results();
            foreach($query as $q){
                $previousMigs[] = $q->migration;
            }
        }
        
        // get all files
        $migrations = glob('migrations'.DS.'*.php');

        foreach($migrations as $fileName){
            $klass = str_replace('migrations'.DS,'',$fileName);
            $klass = str_replace('.php','',$klass);
            if(!in_array($klass,$previousMigs)){
                $klassNamespace = 'Migrations\\'.$klass;
                $mig = new $klassNamespace($isCli);
                $mig->up();
                $db->insert('migrations',['migration'=>$klass]);
                $migrationsRun[] = $klassNamespace;
            }
        }

        if(sizeof($migrationsRun) == 0){
            if($isCli){
                echo "\e[0;37;42m\n\n"."    No new migrations to run.\n\e[0m\n";
            } else {
            echo '<p style="color:#006600;">No new migrations to run.</p>';
            }
        }

        return Command::SUCCESS;
    }
}
