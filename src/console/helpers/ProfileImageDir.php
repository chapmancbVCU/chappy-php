<?php
namespace Console\App\Helpers;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Symfony\Component\Console\Command\Command;

class ProfileImageDir {
    private static $_path = ROOT.DS.'public'.DS.'images'.DS.'uploads'.DS.'profile_images';

    public static function mkdirProfileImages(): int {
        if(!file_exists(self::$_path)) {
            mkdir(self::$_path, 0775, true);
        } else {
            echo "\e[0;37;42m\n\n"."    The profile_images directory already exists.\n\e[0m\n";
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

    public static function rmdirProfileImageDirectories(): int {
        $it = new RecursiveDirectoryIterator(self::$_path, RecursiveDirectoryIterator::SKIP_DOTS);
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