<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Core\Lib\Database\Seeder;
use App\Models\Contacts;
use Console\App\Helpers\Tools;
/**
 * Seeder for contacts table.
 * 
 * @return void
 */
class ContactsTableSeeder extends Seeder {
    public function run(): void {
        $faker = Faker::create();
        
        $numberOfContacts = 5;
        for($i = 0; $i < $numberOfContacts; $i++) {
            $contact = new Contacts();
            $contact->fname = $faker->name;
            $contact->lname = $faker->name;
            $contact->email = $faker->unique()->safeEmail;
            $contact->address = $faker->address;
            $contact->city = $faker->city;
            $contact->state = 'VA';
            $contact->zip = '12345';
            $contact->home_phone = $faker->phoneNumber;
            $contact->user_id = 1;
            $contact->save();
        }
        Tools::info("Seeded contacts table.");
    }
}