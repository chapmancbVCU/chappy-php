<?php
namespace Console\Helpers;

use Database\Seeders\DatabaseSeeder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
/**
 * Supports operations related to database seeding.
 */
class DBSeeder {

    public static function makeSeeder(InputInterface $input): int {
        $seederName = $input->getArgument('seeder-name');
        if (php_sapi_name() != 'cli') die('Restricted');
        $ext = ".php";
        $fullPath = ROOT.DS.'database'.DS.'seeders'.DS.ucfirst($seederName).'TableSeeder'.$ext;
        $content = '<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Core\Lib\Database\Seeder;
use Console\Helpers\Tools;

// Import your model
use App\Models\\'.ucfirst($seederName).';

/**
 * Seeder for '.lcfirst($seederName).' table.
 * 
 * @return void
 */
class '.ucfirst($seederName).'TableSeeder extends Seeder {
    /**
     * Runs the database seeder
     *
     * @return void
     */
    public function run(): void {
        $faker = Faker::create();
        
        // Set number of records to create.
        $numberOfRecords = 10;
        $i = 0;
        while($i < $numberOfRecords) {
            $'.lcfirst($seederName).' = new '.ucfirst($seederName).'();
            

            if($'.lcfirst($seederName).'->save()) {
                $i++;
            }
        }
        Tools::info("Seeded '.lcfirst($seederName).' table.");
    }
}
';
        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            Tools::info('Seeder class already exists', 'red');
            return Command::FAILURE;
        }

        Tools::info('Seeder class successfully created');
        return Command::SUCCESS;
    }
    
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