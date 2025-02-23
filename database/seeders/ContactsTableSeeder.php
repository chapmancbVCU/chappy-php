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
        $faker = Faker::create('en_us');
        
        $numberOfContacts = 10;
        for($i = 0; $i < $numberOfContacts; $i++) {
            $contact = new Contacts();
            $contact->fname = $faker->name;
            $contact->lname = $faker->name;
            $contact->email = $faker->safeEmail;
            $contact->address = $faker->streetAddress;
            $contact->city = $faker->city;
            $contact->state = $faker->stateAbbr;
            $contact->zip = $faker->postcode;
            $contact->home_phone = $faker->phoneNumber;
            $contact->user_id = 1;
            $contact->save();
        }
        Tools::info("Seeded contacts table.");
    }
}