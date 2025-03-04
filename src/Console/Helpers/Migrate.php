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
        // // Load configuration and helper functions
        // $isCli = php_sapi_name() == 'cli';

        // $db = DB::getInstance();
        // $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        // $previousMigs = [];

        // if(empty($migrationTable)){
        //     Tools::info('Empty database.  No tables to drop.', 'debug', 'red');
        //     return Command::FAILURE;
        // }
        
        // // get all files
        // $migrations = glob('database'.DS.'migrations'.DS.'*.php');

        // foreach($migrations as $fileName){
        //     $klass = str_replace('database'.DS.'migrations'.DS,'',$fileName);
        //     $klass = str_replace('.php','',$klass);
        //     if(!in_array($klass,$previousMigs)){
        //         $klassNamespace = 'Database\\Migrations\\'.$klass;
        //         $mig = new $klassNamespace($isCli);
        //         $mig->down();
        //     }
        // }

        // Tools::info('All tables have been dropped');
        // return Command::SUCCESS;
        // Check if running from CLI
        $isCli = php_sapi_name() == 'cli';

        $db = DB::getInstance();
        if ($db->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite') {
            $db->query("PRAGMA foreign_keys=ON;");
        }
        
        $driver = $db->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $previousMigs = [];

        // Check if the migrations table exists
        if ($driver === 'sqlite') {
            // SQLite method to check if table exists
            $migrationTable = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'")->count();
        } else {
            // MySQL method
            $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->count();
        }

        if ($migrationTable == 0) {
            Tools::info('Empty database. No tables to drop.', 'debug', 'red');
            return Command::FAILURE;
        }

        // Get all migration files
        $migrations = glob('database' . DS . 'migrations' . DS . '*.php');

        // Reverse loop to drop tables in the correct order
        foreach (array_reverse($migrations) as $fileName) {
            $klass = str_replace(['database' . DS . 'migrations' . DS, '.php'], '', $fileName);
            $klassNamespace = 'Database\\Migrations\\' . $klass;

            if (class_exists($klassNamespace)) {
                $mig = new $klassNamespace($isCli);
                $mig->down();  // Drop table
            } else {
                Tools::info("WARNING: Migration class '{$klassNamespace}' not found!", 'error', 'yellow');
            }
        }

        // Clear the migrations table after dropping all tables
        $db->query("DROP TABLE IF EXISTS migrations");

        Tools::info('All tables have been dropped.', 'success', 'green');
        return Command::SUCCESS;
    }

    /**
     * Generates a new migration.
     *
     * @param InputInterface $input 
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeMigration(InputInterface $input): int {
        $tableName = strtolower($input->getArgument('table_name'));
        
        // Generate Migration class
        $fileName = "Migration".time();
        return Tools::writeFile(
            ROOT.DS.'database'.DS.'migrations'.DS.$fileName.'.php',
            self::migrationClass($fileName, $tableName),
            'Migration'
        );
    }

    /**
     * Performs migration operation.
     *
     * @return integer A value that indicates success, invalid, or failure.
     */
    public static function migrate(): int {
        // Load configuration and helper functions
        // $isCli = php_sapi_name() == 'cli';

        // $db = DB::getInstance();
        // $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        // $previousMigs = [];
        // $migrationsRun = [];

        // if(!empty($migrationTable)){
        //     $query = $db->query("SELECT migration FROM migrations")->results();
        //     foreach($query as $q){
        //         $previousMigs[] = $q->migration;
        //     }
        // }
        
        // // get all files
        // $migrations = glob('database'.DS.'migrations'.DS.'*.php');

        // foreach($migrations as $fileName){
        //     $klass = str_replace('database'.DS.'migrations'.DS,'',$fileName);
        //     $klass = str_replace('.php','',$klass);
        //     if(!in_array($klass,$previousMigs)){
        //         $klassNamespace = 'Database\\Migrations\\'.$klass;
        //         $mig = new $klassNamespace($isCli);
        //         $mig->up();
        //         $db->insert('migrations',['migration'=>$klass]);
        //         $migrationsRun[] = $klassNamespace;
        //     }
        // }

        // if(sizeof($migrationsRun) == 0){
        //     Tools::info('No new migrations to run.', 'debug', 'red');
        // }

        // return Command::SUCCESS;

        $isCli = php_sapi_name() == 'cli';

        $db = DB::getInstance();
        $driver = $db->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $previousMigs = [];
        $migrationsRun = [];

        // Check if the migrations table exists
        if ($driver === 'sqlite') {
            // SQLite method to check if table exists
            $migrationTable = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'")->count();
        } else {
            // MySQL method
            $migrationTable = $db->query("SHOW TABLES LIKE 'migrations'")->count();
        }

        // If the migrations table exists, load previous migrations
        if ($migrationTable > 0) {
            $query = $db->query("SELECT migration FROM migrations")->results();
            foreach ($query as $q) {
                $previousMigs[] = $q->migration;
            }
        }

        // Get all migration files
        $migrations = glob('database' . DS . 'migrations' . DS . '*.php');

        foreach ($migrations as $fileName) {
            $klass = str_replace(['database' . DS . 'migrations' . DS, '.php'], '', $fileName);
            
            if (!in_array($klass, $previousMigs)) {
                $klassNamespace = 'Database\\Migrations\\' . $klass;
                
                if (class_exists($klassNamespace)) {
                    $mig = new $klassNamespace($isCli);
                    $mig->up();  // Run migration
                    $db->insert('migrations', ['migration' => $klass]); // Store migration history
                    $migrationsRun[] = $klassNamespace;
                } else {
                    Tools::info("WARNING: Migration class '{$klassNamespace}' not found!", 'error', 'red');
                }
            }
        }

        // Output result
        if (sizeof($migrationsRun) == 0) {
            Tools::info('No new migrations to run.', 'debug', 'yellow');
        } else {
            Tools::info('Migrations completed successfully.', 'success', 'green');
        }

        return Command::SUCCESS;
    }

    /**
     * Generates a new Migration class.
     *
     * @param string $fileName The file name for the Migration class.
     * @param string $tableName The name of the table for the migration.
     * @return string The contents of the new Migration class.
     */
    public static function migrationClass(string $fileName, string $tableName): string {
        return '<?php
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
    }
}