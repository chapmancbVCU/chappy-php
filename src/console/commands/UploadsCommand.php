<?php
namespace Console\Commands;

use Console\App\Helpers\Tools;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Supports ability to create a class that extends the Uploads class.
 */
class UploadsCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:upload')
            ->setDescription('Generates a class that extends the Uploads class')
            ->setHelp('php console make:upload <name_of_upload_type>')
            ->addArgument('upload-type-name', InputArgument::REQUIRED, 'Pass the name of the type of upload you want to create.');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input The input.
     * @param OutputInterface $output The output.
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uploadName = $input->getArgument('upload-type-name');
        if (php_sapi_name() != 'cli') die('Restricted');
        $ext = ".php";
        $fullPath = ROOT.DS.'app'.DS.'lib'.DS.'utilities'.DS.'Upload'.$uploadName.$ext;
        $content = '<?php
namespace App\Lib\Utilities;
use Core\Lib\Utilities\Uploads;

/**
 * Supports the ability to upload ' . $uploadName . ' files.
 */
class Upload'.$uploadName.' extends Uploads {
    /**
     * Creates instance of Upload'.$uploadName.' class.
     *
     * @param array|string $files Array of files or the name to be uploaded.
     * @param array $imageTypes An array containing a list of acceptable file 
     * types for a particular upload action.
     * @param int $maxAllowedSize Maximum allowable size for a particular 
     * file.  This can vary depending on requirements.
     * @param bool $multiple A boolean flag to set whether or not we are 
     * working with a single file upload or an array regarding form setup.
     * @param string $bucket The location where the files will be stored.
     * @param string $sizeMsg The message describing the maximum allowable 
     * size usually described as <size_as_an_int><bytes|mb|gb> (e.g.: 5mb).
     */
    public function __construct(array|string $files, array $fileTypes, int $maxAllowedSize, bool $multiple, string $bucket, string $sizeMsg) {
        parent::__construct($files, $fileTypes, $maxAllowedSize, $multiple, $bucket, $sizeMsg);
    }

    /**
     * Performs validation on file uploads.
     *
     * @return void
     */
    public function runValidation(): void {
        $this->validateSize();
        $this->validateFileType();
    }
    
    /**
     * Validates file type and sets error message if file type is invalid.
     *
     * @return void
     */
    protected function validateFileType(): void { 
        // Setup file type reporting.

        // Perform validation and set error messages.
    }
}
';
        if(!file_exists($fullPath)) {
            $resp = file_put_contents($fullPath, $content);
        } else {
            Tools::info('Upload class already exists', 'red');
            return Command::FAILURE;
        }

        Tools::info('Upload class successfully created');
        return Command::SUCCESS;
    }
}
