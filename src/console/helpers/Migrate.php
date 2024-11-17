<?php
namespace Console\App\Helpers;

use Core\DB;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Symfony\Component\Console\Command\Command;

class Migrate {
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
        // self::removeDir(ROOT.DS.'public'.DS.'images'.DS.'uploads'.DS .'profile_images'.DS);
        return Command::SUCCESS;
    }

    // public static function removeDir(string $dir): void {
    //     $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    //     $files = new RecursiveIteratorIterator($it,
    //                  RecursiveIteratorIterator::CHILD_FIRST);
    //     foreach($files as $file) {
    //         if ($file->isDir()){
    //             rmdir($file->getPathname());
    //         } else {
    //             unlink($file->getPathname());
    //         }
    //     }
    //     rmdir($dir);
    // }
}