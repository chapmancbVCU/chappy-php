<?php
namespace Database\Seeders;

use Core\Lib\Database\Seeder;
use Database\Seeders\ContactsTableSeeder;

/**
 * Supports ability to call seeder classes.
 */
class DatabaseSeeder extends Seeder {
    /**
     * Call individual seeders in proper order.
     *
     * @return void
     */
    public function run(): void {
        $this->call(ContactsTableSeeder::class);
    }
}