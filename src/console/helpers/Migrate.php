<?php
namespace Console\App\Helpers;

use Core\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate {
    public static function dropAllTables(): int {
        // Load configuration and helper functions
        $isCli = php_sapi_name() == 'cli';

        $db = DB::getInstance();
        $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        $previousMigs = [];

        if(empty($migrationTable)){
            echo "\e[0;37;42m\n\n"."    Empty database.  No tables to drop.\n\e[0m\n";
            return Command::FAILURE;
        }
        
        // get all files
        $migrations = glob('migrations'.DS.'*.php');

        foreach($migrations as $fileName){
            $klass = str_replace('migrations'.DS,'',$fileName);
            $klass = str_replace('.php','',$klass);
            if(!in_array($klass,$previousMigs)){
                $klassNamespace = 'Migrations\\'.$klass;
                $mig = new $klassNamespace($isCli);
                $mig->down();
            }
        }
        return Command::SUCCESS;
    }

    public static function makeMigration(InputInterface $input, OutputInterface $output): int {
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
        $this->dropTable(\''.$tableName.'\');
    }
}
';
        $resp = file_put_contents($fullPath, $content);

        return Command::SUCCESS;
    }

    public static function migrate(): int {
        // Load configuration and helper functions
        $isCli = php_sapi_name() == 'cli';

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