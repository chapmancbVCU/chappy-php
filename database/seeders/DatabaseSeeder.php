<?php
namespace Database\Seeders;

use Core\Lib\Database\Seeder;
use Database\Seeders\ContactsTableSeeder;
class DatabaseSeeder extends Seeder {
    public function run() {
        // Call individual seeders in proper order
        $this->call(ContactsTableSeeder::class);
    }
}