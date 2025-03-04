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
        $pdo = $db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

        // Check for migrations table
        if ($dbDriver === 'sqlite') {
            $query = "SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'";
        } else {
            $query = "SHOW TABLES LIKE 'migrations'";
        }

        $migrationTable = $db->query($query)->results();
        $previousMigs = [];

        if (empty($migrationTable)) {
            Tools::info('Empty database. No tables to drop.', 'debug', 'red');
            return Command::FAILURE;
        }

        // Get all migration files
        $migrations = glob(ROOT . DS . 'database' . DS . 'migrations' . DS . '*.php');

        foreach ($migrations as $fileName) {
            $klass = basename($fileName, '.php'); // Extract class name from filename
            if (!in_array($klass, $previousMigs)) {
                $klassNamespace = 'Database\\Migrations\\' . $klass;
                $mig = new $klassNamespace($isCli);
                $mig->down();
            }
        }

        // Drop migrations table
        $db->dropTable('migrations');
        Tools::info('All tables have been dropped.');
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
        $isCli = php_sapi_name() == 'cli';
        $db = DB::getInstance();
        $pdo = $db->getPDO();
        $dbDriver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    
        // Ensure the migrations table exists
        if ($dbDriver === 'sqlite') {
            $checkTable = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='migrations'")->results();
        } else {
            $checkTable = $db->query("SHOW TABLES LIKE 'migrations'")->results();
        }
    
        if (empty($checkTable)) {
            $columns = [
                'id' => ($dbDriver === 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY',
                'migration' => 'VARCHAR(255) NOT NULL'
            ];
            $db->createTable('migrations', $columns);
        }
    
        $previousMigs = [];
        if (!empty($checkTable)) {
            $query = $db->query("SELECT migration FROM migrations")->results();
            foreach ($query as $q) {
                $previousMigs[] = $q->migration;
            }
        }
    
        // Get all migration files
        $migrations = glob(ROOT . DS . 'database' . DS . 'migrations' . DS . '*.php');
        $migrationsRun = [];
    
        foreach ($migrations as $fileName) {
            $klass = basename($fileName, '.php');
            if (!in_array($klass, $previousMigs)) {
                $klassNamespace = 'Database\\Migrations\\' . $klass;
                $mig = new $klassNamespace($isCli);
                $mig->up();
                $db->insert('migrations', ['migration' => $klass]);
                $migrationsRun[] = $klassNamespace;
            }
        }
    
        if (sizeof($migrationsRun) == 0) {
            Tools::info('No new migrations to run.', 'debug', 'red');
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