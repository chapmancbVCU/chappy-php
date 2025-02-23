<?php
namespace Console\App\Helpers;

use Database\Seeders\DatabaseSeeder;
use Symfony\Component\Console\Command\Command;
/**
 * Supports operations related to database seeding.
 */
class DBSeeder {

    /**
     * Runs command for seeding database.
     *
     * @return integer
     */
    public static function seed(): int {
        $seeder = new DatabaseSeeder();
        $seeder->run();
        Tools::info('Database seeding complete');
        return Command::SUCCESS;
    }
}