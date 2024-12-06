<?php
namespace Console\App\Helpers;

use Core\DB;
use PDO;
use PDOException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

class Migrate {
    public static function createDatabase(string $host, string $user, string $dbName, string $password): int {
        try {
            $db = new PDO("mysql:host=".$host, $user, $password);
            $db->exec("CREATE DATABASE `$dbName`;");
        } catch(PDOException $e) {
            Tools::info($e->getMessage(), 'red');
            return Command::FAILURE;
        }
        Tools::info("The ".$dbName." database was successfully created.");
        return Command::SUCCESS;
    }

    public static function createUser(string $host, string $user, string $dbName, string $password): int {

        // try {
        //     $dbh = new PDO("mysql:host=$host", $root, $root_password);
    
        //     $dbh->exec("CREATE DATABASE `$db`;
        //             CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
        //             GRANT ALL ON `$db`.* TO '$user'@'localhost';
        //             FLUSH PRIVILEGES;")
        //     or die(print_r($dbh->errorInfo(), true));
    
        // }
        // catch (PDOException $e) {
        //     die("DB ERROR: " . $e->getMessage());
        // }

        try {
            $db = new PDO("mysql:host=".$host, $user, $password);
            $db->exec("CREATE USER '$user'@'$host' IDENTIFIED BY '$password';
                GRANT ALL ON `$dbName`.* TO '$user'@'$host';");
        } catch(PDOException $e) {
            Tools::info($e->getMessage(), 'red');
            return Command::FAILURE;
        }
        Tools::info("The ".$user." was successfully created.");
        return Command::SUCCESS;
    }

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