<?php
namespace Console\App\Helpers;

use Core\DB;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Symfony\Component\Console\Command\Command;

class ProfileImageDir {
    public static function mkdirProfileImages(): int {
        $path = ROOT.DS.'public'.DS.'images'.DS.'uploads'.DS.'profile_images';
        if(!file_exists($path)) {
            mkdir($path, 0775, true);
        } else {
            echo "\e[0;37;42m\n\n"."    The profile_images directory already exists.\n\e[0m\n";
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

    public static function rmdirProfileImageDirectories(): int {
        $dir = ROOT.DS.'public'.DS.'images'.DS.'uploads'.DS .'profile_images'.DS;
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
                     RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        return Command::SUCCESS;
    }
}