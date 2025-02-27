<?php
namespace Console\Helpers;

use Database\Seeders\DatabaseSeeder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
/**
 * Supports operations related to database seeding.
 */
class DBSeeder {

    /**
     * Creates a class for seeding a database.
     *
     * @param InputInterface $input The input for getting name of seeder class.
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeSeeder(InputInterface $input): int {
        $seederName = ucfirst($input->getArgument('seeder-name'));
        if (php_sapi_name() != 'cli') die('Restricted');

        // Generate Seeder class
        return Tools::writeFile(
            ROOT.DS.'database'.DS.'seeders'.DS.$seederName.'TableSeeder.php',
            self::seeder($seederName),
            'Seeder'
        );
    }
    
    /**
     * Runs command for seeding database.
     *
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function seed(): int {
        $seeder = new DatabaseSeeder();
        $seeder->run();
        Tools::info('Database seeding complete');
        return Command::SUCCESS;
    }

    /**
     * Returns a string containing contents of a new Seeder class.
     *
     * @param string $seederName The name of the Seeder class.
     * @return string The contents of the seeder class.
     */
    public static function seeder(string $seederName): string {
        return '<?php
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
    }
}