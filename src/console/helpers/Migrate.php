<?php
namespace Console\Helpers;

use Core\DB;
use PDO;
use PDOException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Helper class for migration related console commands.
 */
class Migrate {
    /**
     * Drops all migrations.
     *
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function dropAllTables(): int {
        // Load configuration and helper functions
        $isCli = php_sapi_name() == 'cli';

        $db = DB::getInstance();
        $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        $previousMigs = [];

        if(empty($migrationTable)){
            Tools::info('Empty database.  No tables to drop.', 'red');
            return Command::FAILURE;
        }
        
        // get all files
        $migrations = glob('database'.DS.'migrations'.DS.'*.php');

        foreach($migrations as $fileName){
            $klass = str_replace('database'.DS.'migrations'.DS,'',$fileName);
            $klass = str_replace('.php','',$klass);
            if(!in_array($klass,$previousMigs)){
                $klassNamespace = 'Database\\Migrations\\'.$klass;
                $mig = new $klassNamespace($isCli);
                $mig->down();
            }
        }

        Tools::info('All tables have been dropped');
        return Command::SUCCESS;
    }

    /**
     * Generates a new migration.
     *
     * @param InputInterface $input 
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeMigration(InputInterface $input): int {
        $tableName = $input->getArgument('table_name');
        if (php_sapi_name() != 'cli') die('Restricted');
        $fileName = "Migration".time();
        $ext = ".php";
        $fullPath = ROOT.DS.'database'.DS.'migrations'.DS.$fileName.$ext;
        $content = '<?php
namespace Database\Migrations;
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
        Tools::info('New migration file created');
        return Command::SUCCESS;
    }

    /**
     * Performs migration operation.
     *
     * @return integer A value that indicates success, invalid, or failure.
     */
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
        $migrations = glob('database'.DS.'migrations'.DS.'*.php');

        foreach($migrations as $fileName){
            $klass = str_replace('database'.DS.'migrations'.DS,'',$fileName);
            $klass = str_replace('.php','',$klass);
            if(!in_array($klass,$previousMigs)){
                $klassNamespace = 'Database\\Migrations\\'.$klass;
                $mig = new $klassNamespace($isCli);
                $mig->up();
                $db->insert('migrations',['migration'=>$klass]);
                $migrationsRun[] = $klassNamespace;
            }
        }

        if(sizeof($migrationsRun) == 0){
            Tools::info('No new migrations to run.', 'red');
        }

        return Command::SUCCESS;
    }
}